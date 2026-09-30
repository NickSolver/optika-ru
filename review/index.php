<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Отзывы о компании Lokamed");
$APPLICATION->SetTitle("Отзывы о компании Lokamed");
?>
<main class="container">
	
	<div class="reviews-title">
		<h1>Отзывы</h1>

	</div>
    <div style="max-width:762px;height:800px;overflow:hidden;position:relative; margin: 0 auto;">
    <select id="selectorOptik">
        <option value="72683660408">Одинцово, Можайское ш., 66 б</option>
        <option value="53206336483">к2008, Зеленоград</option>
        <option value="176051066597">Жилинская   ул., 1, Андреевка</option>
        <option value="41989077538">Ангелов   пер., 8, Москва</option>
        <option value="201408625975">к1824, Зеленоград</option>
        <option value="206422908278">к834А, Зеленоград</option>
        <option value="8200665506">к241, Зеленоград</option>
    </select><br><br>

        <iframe id="widget" style="width:100%;height:100%;border:1px solid #e6e6e6;border-radius:8px;box-sizing:border-box" src="https://yandex.ru/maps-reviews-widget/72683660408?comments"></iframe>
    </div>

    <script>
        $('#selectorOptik').on('change', function() {
            var selectedValue = $(this).val();
            var newSrc = 'https://yandex.ru/maps-reviews-widget/' + selectedValue + '?comments';
            $('#widget').attr('src', newSrc);
        });
    </script>

</main>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>