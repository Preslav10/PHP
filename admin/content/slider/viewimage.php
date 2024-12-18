<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <title>Списък със слайдери</title>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Списък със Слайдери</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Управление на Слайдери</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Корица</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sliderTable">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>

    <script>
        function loadSliders() {
            fetch('fetch_slider.php')
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.getElementById('sliderTable');
                    tableBody.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(slider => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td><img src="content/slider/images/slideralbums/${slider.cover_image}" alt="Слайдер" style="max-width: 100px; max-height: 100px;"></td>
                                <td>
                                    <a href="edit4.php?id=${slider.id}" class="btn btn-sm btn-warning">Редактирай</a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteSlider(${slider.id}, this)">Изтрий</button>
                                </td>
                            `;
                            tableBody.appendChild(row);
                        });
                    } else {
                        tableBody.innerHTML = '<tr><td colspan="2">Няма налични слайдери.</td></tr>';
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        function deleteSlider(sliderId, button) {
            if (!confirm("Сигурни ли сте, че искате да изтриете този слайдер?")) return;

            fetch('./handlers/delete_slider.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: sliderId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = button.closest('tr');
                    row.parentNode.removeChild(row);
                } else {
                    alert(data.message || 'Грешка при изтриването.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Неуспешно изтриване.');
            });
        }
        document.addEventListener('DOMContentLoaded', loadSliders);
    </script>
</body>
</html>
