<?php
$translations = [
    'en' => [
        'men' => 'Men',
        'women' => 'Women',
        'children' => 'Children',
        'contacts' => 'Contacts',
        'shoes' => 'Shoes',
        'jeans' => 'Jeans',
        'shirts' => 'Shirts',
    ],
    'bg' => [
        'men' => 'Мъже',
        'women' => 'Жени',
        'children' => 'Деца',
        'contacts' => 'Контакти',
        'shoes' => 'Обувки',
        'jeans' => 'Дънки',
        'shirts' => 'Тениски',
    ],
];

if (isset($_GET['lang']) && array_key_exists($_GET['lang'], $translations)) {
    $current_language = $_GET['lang'];
} else {
    $current_language = 'bg'; 
}

$current_translations = $translations[$current_language];
$current_page = $_GET['page'] ?? 'home';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($current_language, ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .title-container {
        display: block;
        white-space: pre-line; 
    }
    .group:hover > .absolute {
        display: block !important;
        animation: fade-in 0.2s ease-in-out;
    }

    .group > .absolute {
        display: none;
        animation: fade-out 0.3s ease-in-out;
    }

    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fade-out {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-5px); }
    }

    .flag-img {
        width: 100%;
        height: auto;
        max-width: 1.5rem;
        max-height: 1.5rem;
    }
</style>

</head>
<body class="box-border">
  <div class="w-full h-10 bg-gray-900 p-1">
      <div class="flex items-center justify-end w-full">
        <button type="button" data-dropdown-toggle="language-dropdown-menu"
            class="inline-flex items-center font-medium justify-center px-4 py-1 text-sm text-gray-900 dark:text-white rounded-lg cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-white bg-gray-100">
          <img id="language-flag" class="flag-img me-3" src="" alt="Language Flag">
          <span id="current-language"></span>
        </button>
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700"
            id="language-dropdown-menu">
          <ul class="py-2 font-medium" role="none">
            <li>
              <a href="#" onclick="setLanguage('en'); return false;" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                <div class="inline-flex items-center">
                  <img src="images/uk-circle-01.png" alt="English Flag" class="flag-img me-2">
                  English
                </div>
              </a>
            </li>
            <li>
              <a href="#" onclick="setLanguage('bg'); return false;" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                <div class="inline-flex items-center">
                  <img src="images/bg-circle-01.png" alt="Bulgarian Flag" class="flag-img me-2">
                  Български
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>       
    </div>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="?page=home" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="images/logo.png" class="h-8" alt="Flowbite Logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">UrbanThreads</span>
      </a>    
      <div class="flex md:order-2">
             <button class="flex items-center justify-center w-10 h-10 text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full p-2.5 me-2 focus:outline-none relative">
                  <a href="?page=payment/cart" class="cart-button" title="View Cart">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.878 5.488a2 2 0 001.995 1.738h10.254a2 2 0 001.995-1.738L19 3H3zm6 12a2 2 0 110-4 2 2 0 010 4zm6 0a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                    <span class="sr-only">Cart</span>
                  </a>
                  <span id="cart-count" class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">0</span>
            </button>
            <script>
              function updateCartCount() {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'cart_count.php', true);
                xhr.onload = function() {
                  if (xhr.status === 200) {
                    try {
                      const response = JSON.parse(xhr.responseText);
                      const count = response.count || 0;
                      document.getElementById('cart-count').textContent = count;
                    } catch (error) {
                      console.error('Error parsing cart count response:', error);
                    }
                  } else {
                    console.error('Error fetching cart count:', xhr.statusText);
                  }
                };
                xhr.send();
              }
              window.onload = function() {
                updateCartCount(); 
                setInterval(updateCartCount, 5000); 
              };
            </script>
        <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false" class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
          </svg>
          <span class="sr-only">Search</span>
        </button>
        <div class="relative hidden md:block">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search icon</span>
          </div>
          <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
        </div>
        <button data-collapse-toggle="navbar-search" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-search" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
      </div>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">

      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li class="relative group">
          <button class="block py-2 px-3 text-white  rounded md:bg-transparent md:text-gray-700 md:p-0 md:dark:text-blue-500 menu-item" data-translate-key="men">
            <?php echo $current_translations['men']; ?>
          </button>

          <div id="mega-menu-men" class="absolute z-[9999] hidden w-auto grid-cols-3 grid text-sm bg-white border border-gray-100 rounded-lg shadow-md group-hover:grid dark:border-gray-700 dark:bg-gray-700" style="left: 0; top: 100%;">
            <div class="p-4 pb-0 text-gray-900 dark:text-white">
              <ul class="space-y-4">
                <li>
                    <a href="?page=mens/3" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 menu-item" data-translate-key="shoes">
                        <?php echo $current_translations['shoes']; ?>
                    </a>
                </li>
                <li>
                    <a href="?page=mens/4" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 menu-item" data-translate-key="jeans">
                        <?php echo $current_translations['jeans']; ?>
                    </a>
                </li>
                <li>
                    <a href="?page=mens/5" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 menu-item" data-translate-key="shirts">
                        <?php echo $current_translations['shirts']; ?>
                    </a>
                </li>
            </ul>
            </div>
          </div>
        </li>

        <li class="relative group">
          <button class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent  md:text-gray-700 md:p-0 md:dark:text-blue-500 menu-item" data-translate-key="women">
            <?php echo $current_translations['women']; ?>
          </button>

          <div id="mega-menu-women" class="absolute z-[9999] hidden w-auto grid-cols-3 grid text-sm bg-white border border-gray-100 rounded-lg shadow-md group-hover:grid dark:border-gray-700 dark:bg-gray-700" style="left: 0; top: 100%;">
            <div class="p-4 pb-0 text-gray-900 dark:text-white">
            <ul class="space-y-4">
                <li>
                    <a href="?page=women/6" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 menu-item" data-translate-key="shoes">
                        <?php echo $current_translations['shoes']; ?>
                    </a>
                </li>
                <li>
                    <a href="?page=women/8" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 menu-item" data-translate-key="jeans">
                        <?php echo $current_translations['jeans']; ?>
                    </a>
                </li>
                <li>
                    <a href="?page=women/7" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 menu-item" data-translate-key="shirts">
                        <?php echo $current_translations['shirts']; ?>
                    </a>
                </li>
            </ul>
            </div>
          </div>
        </li>

        <li class="relative group">
          <button class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent  md:text-gray-700 md:p-0 md:dark:text-blue-500 menu-item" data-translate-key="children">
            <?php echo $current_translations['children']; ?>
          </button>
          <div id="mega-menu-children" class="absolute z-[9999] hidden w-auto grid-cols-3 grid text-sm bg-white border border-gray-100 rounded-lg shadow-md group-hover:grid dark:border-gray-700 dark:bg-gray-700" style="left: 0; top: 100%;">
            <div class="p-4 pb-0 text-gray-900 dark:text-white">
            <ul class="space-y-4">
                <li>
                    <a href="?page=kids/9" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 menu-item" data-translate-key="shoes">
                        <?php echo $current_translations['shoes']; ?>
                    </a>
                </li>
                <li>
                    <a href="?page=kids/10" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 menu-item" data-translate-key="jeans">
                        <?php echo $current_translations['jeans']; ?>
                    </a>
                </li>
                <li>
                    <a href="?page=kids/11" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 menu-item" data-translate-key="shirts">
                        <?php echo $current_translations['shirts']; ?>
                    </a>
                </li>
            </ul>
            </div>
          </div>
        </li>
        <li>
          <a href="?page=contacts" class="block py-2 px-3 text-gray-900 rounded md:bg-transparent  md:text-gray-700 md:p-0 md:dark:text-blue-500 menu-item" data-translate-key="contacts">
            <?php echo $current_translations['contacts']; ?>
          </a>
        </li>
      </ul>
    </div>
    </div>
    </nav>
      <script>
  function initializeLanguage() {
    const currentLang = '<?php echo $current_language; ?>';
    updateLanguageDisplay(currentLang);
  }
  function updateLanguageDisplay(language) {
    const languageMap = {
      'bg': { flagSrc: 'images/bg-circle-01.png', langText: 'Български' },
      'en': { flagSrc: 'images/uk-circle-01.png', langText: 'English' }
    };

    const languageData = languageMap[language] || languageMap['bg'];
    document.getElementById('language-flag').src = languageData.flagSrc;
    document.getElementById('current-language').textContent = languageData.langText;
  }
  function setLanguage(language) {
    const params = new URLSearchParams(window.location.search);
    params.set('lang', language);
    history.pushState({}, '', '?' + params.toString()); 
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `translations.php?lang=${language}`, true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        try {
          const translations = JSON.parse(xhr.responseText);
          updateTranslations(translations, language);
        } catch (error) {
          console.error('Error parsing translations:', error);
        }
      } else {
        console.error('Error fetching translations:', xhr.statusText);
      }
    };
    xhr.send();
  }
  function updateTranslations(translations, language) {
    document.querySelectorAll('.menu-item').forEach(item => {
      const key = item.getAttribute('data-translate-key');
      if (translations[key]) {
        item.textContent = translations[key];
      }
    });
    updateLanguageDisplay(language); 
  }
  initializeLanguage();
</script>
</body>
</html>