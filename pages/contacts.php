<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$error = '';
$sendStatus = '';
$name = '';
$email = '';
$subject = '';
$message = '';

$translations = [
    'en' => [
        'contact_us' => 'Contact Us',
        'fill_form' => 'Fill up the form below to send us a message.',
        'name' => 'Name',
        'email' => 'Email Address',
        'subject' => 'Subject',
        'message' => 'Message',
        'submit' => 'Send',
        'error_name' => 'Please Enter your Name',
        'error_name_format' => 'Only letters and white space allowed',
        'error_email' => 'Please Enter your Email',
        'error_email_format' => 'Invalid email format',
        'error_subject' => 'Subject is required',
        'error_message' => 'Message is required',
        'thank_you' => 'Thank you for contacting us',
        'error_sending' => 'There was an error sending the email: '
    ],
    'bg' => [
        'contact_us' => 'Свържи се с нас',
        'fill_form' => 'Попълнете формуляра по-долу, за да ни изпратите съобщение.',
        'name' => 'Име',
        'email' => 'Имейл адрес',
        'subject' => 'Тема',
        'message' => 'Съобщение',
        'submit' => 'Изпрати',
        'error_name' => 'Моля, въведете вашето име',
        'error_name_format' => 'Позволени са само букви и интервали',
        'error_email' => 'Моля, въведете вашия имейл',
        'error_email_format' => 'Невалиден имейл формат',
        'error_subject' => 'Темата е задължителна',
        'error_message' => 'Съобщението е задължително',
        'thank_you' => 'Благодарим ви, че се свързахте с нас',
        'error_sending' => 'Възникна грешка при изпращането на имейла: '
    ]
];

$lang = isset($_GET['lang']) ? $_GET['lang'] : (isset($_SESSION['language']) ? $_SESSION['language'] : 'en');
$lang = in_array($lang, ['en', 'bg']) ? $lang : 'en';
$_SESSION['language'] = $lang;

$currentTranslations = $translations[$lang];

function clean_text($string) {
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $error .= '<p><label class="text-red-500">' . $currentTranslations['error_name'] . '</label></p>';
    } else {
        $name = clean_text($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $error .= '<p><label class="text-red-500">' . $currentTranslations['error_name_format'] . '</label></p>';
        }
    }

    if (empty($_POST["email"])) {
        $error .= '<p><label class="text-red-500">' . $currentTranslations['error_email'] . '</label></p>';
    } else {
        $email = clean_text($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= '<p><label class="text-red-500">' . $currentTranslations['error_email_format'] . '</label></p>';
        }
    }

    if (empty($_POST["subject"])) {
        $error .= '<p><label class="text-red-500">' . $currentTranslations['error_subject'] . '</label></p>';
    } else {
        $subject = clean_text($_POST["subject"]);
    }

    if (empty($_POST["message"])) {
        $error .= '<p><label class="text-red-500">' . $currentTranslations['error_message'] . '</label></p>';
    } else {
        $message = clean_text($_POST["message"]);
    }

    if ($error == '') {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'preslavpenkov604@gmail.com';
            $mail->Password = 'ktza gmyc gbcv deao';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($email, $name);
            $mail->addAddress('preslavpenkov604@gmail.com', 'Recipient Name');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = strip_tags($message);

            $mail->send();
            $sendStatus = '<p class="text-green-500">' . $currentTranslations['thank_you'] . '</p>';
        } catch (Exception $e) {
            $sendStatus = '<p class="text-red-500">' . $currentTranslations['error_sending'] . $mail->ErrorInfo . '</p>';
        }
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($lang, ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($currentTranslations['contact_us'], ENT_QUOTES, 'UTF-8'); ?></title>
    
</head>
<body class="bg-gray-200">
    <div class="flex items-center min-h-screen bg-gray-200 dark:bg-gray-900">
        <div class="container mx-auto">
            <div class="max-w-md mx-auto my-10 bg-white dark:bg-gray-800 p-5 rounded-md shadow-sm">
                <div class="text-center">
                    <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">
                        <?php echo htmlspecialchars($currentTranslations['contact_us'], ENT_QUOTES, 'UTF-8'); ?>
                    </h1>
                    <p class="text-gray-400 dark:text-gray-400">
                        <?php echo htmlspecialchars($currentTranslations['fill_form'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                </div>
                <div class="m-7">
                    <form action="" method="post" id="form">
                        <div class="mb-6">
                            <label for="name" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">
                                <?php echo htmlspecialchars($currentTranslations['name'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                            <input type="text" name="name" id="name" placeholder="" value="<?php echo htmlspecialchars($name); ?>" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">
                                <?php echo htmlspecialchars($currentTranslations['email'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                            <input type="email" name="email" id="email" placeholder="" value="<?php echo htmlspecialchars($email); ?>" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        </div>
                        <div class="mb-6">
                            <label for="subject" class="text-sm text-gray-600 dark:text-gray-400">
                                <?php echo htmlspecialchars($currentTranslations['subject'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                            <input type="text" name="subject" id="subject" placeholder="" value="<?php echo htmlspecialchars($subject); ?>" required class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" />
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">
                                <?php echo htmlspecialchars($currentTranslations['message'], ENT_QUOTES, 'UTF-8'); ?>
                            </label>
                            <textarea rows="5" name="message" id="message" placeholder="Your Message" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" required><?php echo htmlspecialchars($message); ?></textarea>
                        </div>
                        <div class="mb-6">
                            <button type="submit" name="submit" class="w-full px-3 py-4 text-white bg-indigo-500 rounded-md focus:bg-indigo-600 focus:outline-none">
                                <?php echo htmlspecialchars($currentTranslations['submit'], ENT_QUOTES, 'UTF-8'); ?>
                            </button>
                        </div>
                        <p class="text-base text-center text-gray-400" id="result">
                            <?php echo $sendStatus; ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <button id="scrollToTopBtn" class="fixed bottom-5 right-5 w-12 h-12 bg-blue-800 rounded-lg shadow-lg flex items-center justify-center cursor-pointer hover:bg-blue-700 focus:outline-none transition-transform transform hover:scale-105">
        <img src="images/222.png" alt="Scroll to Top" class="w-8 h-8" />
    </button>
    <style>
        #scrollToTopBtn {
            display: none;
        }
    </style>
    <script>
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollToTopBtn.style.display = 'flex'; 
            } else {
                scrollToTopBtn.style.display = 'none';
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

</body>
</html>
