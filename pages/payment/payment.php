<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма за плащане</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <div style="max-width: 500px; margin: 50px auto; padding: 20px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px;">
        <h2 style="text-align: center; margin-bottom: 20px;">Форма за плащане</h2>
        <form id="paymentForm" action="process_payment.php" method="POST" onsubmit="return showMessage(event)">
           
            <label for="name" style="display: block; margin: 10px 0 5px; font-weight: bold;">Име и фамилия</label>
            <input type="text" id="name" name="name" placeholder="Въведете вашето име" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
            
            <label for="email" style="display: block; margin: 10px 0 5px; font-weight: bold;">Имейл</label>
            <input type="email" id="email" name="email" placeholder="Въведете вашия имейл" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
            
            <label for="address" style="display: block; margin: 10px 0 5px; font-weight: bold;">Адрес</label>
            <input type="text" id="address" name="address" placeholder="Въведете адрес за доставка" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
             
            <label for="card_number" style="display: block; margin: 10px 0 5px; font-weight: bold;">Номер на картата</label>
            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" maxlength="16" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
            
            <label for="exp_date" style="display: block; margin: 10px 0 5px; font-weight: bold;">Срок на валидност</label>
            <input type="month" id="exp_date" name="exp_date" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
            
            <label for="cvv" style="display: block; margin: 10px 0 5px; font-weight: bold;">CVV</label>
            <input type="password" id="cvv" name="cvv" placeholder="123" maxlength="3" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">
            
            <button type="submit" style="width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                Плати сега
            </button>
        </form>
    </div>

    <script>
        function showMessage(event) {
            event.preventDefault(); 
            alert("Успешно закупено");
            document.getElementById("paymentForm").reset(); 
            return false; 
        }
    </script>
</body>
</html>
