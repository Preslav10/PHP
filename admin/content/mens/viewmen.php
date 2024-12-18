<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid left-aligned">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Списък със съдържание</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Списък с Продукти</h3>
                            </div>
                            <div class="card-body">
                                <!-- Dropdown за категории -->
                                <div class="mb-3">
                                    <label for="categoryFilter">Изберете категория:</label>
                                    <select id="categoryFilter" class="form-control" onchange="filterProducts()">
                                        <option value="">Всички категории</option>
                                        <option value="Категория 1">Обувки</option>
                                        <option value="Категория 2">Дънки</option>
                                        <option value="Категория 3">Тениски</option>
                                    </select>
                                </div>
                                <!-- Таблицата -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Снимка</th>
                                            <th>Име на продукта</th>
                                            <th>Цена</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productTable">
                                        <!-- Продуктите ще се зареждат тук чрез AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
function filterProducts() {
    const selectedCategory = document.getElementById('categoryFilter').value;

    // Актуализиране на URL-то
    const url = new URL(window.location);
    url.searchParams.set('category', selectedCategory);
    window.history.pushState({}, '', url);

    // AJAX заявка за извличане на данни
    fetch(`fetch_products_men.php?category=${selectedCategory}`)
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('productTable');
            tableBody.innerHTML = ''; // Изчистване на текущите редове

            if (data.length > 0) {
                data.forEach(product => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td><img src="content/mens/images/albums/${product.image}" alt="Снимка" style="max-width: 100px; max-height: 100px;"></td>
                    <td>${product.product_name}</td>
                    <td>${product.price} лв.</td>
                    <td>
                        <a href="edit.php?id=${product.id}&category=${selectedCategory}" class='btn btn-sm btn-warning'>Редактирай</a>
                        <form method='POST' action='./handlers/delate/handle_delete_product.php' style='display:inline;'>
                            <input type='hidden' name='id' value='${product.id}' />
                            <input type='hidden' name='category' value='${selectedCategory}' />  <!-- Добавяме скритото поле за категория -->
                            <button type='submit' class='btn btn-sm btn-danger'>Изтрий</button>
                        </form>
                    </td>`;

                    tableBody.appendChild(row);
                });
            } else {
                tableBody.innerHTML = '<tr><td colspan="4">Няма налични продукти.</td></tr>';
            }
        })
        .catch(error => console.error('Error:', error));
}

// Задаване на избора в dropdown при зареждане на страницата
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const selectedCategory = urlParams.get('category');

    if (selectedCategory) {
        document.getElementById('categoryFilter').value = selectedCategory;
        filterProducts(); // Зареждане на продуктите според избраната категория
    }
});

    </script>
</body>
</html>
