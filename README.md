
tagsTemplate
--------------------------------------------------------------------------------

Компонент основан на плагине Mobile Detection (автор: Zuriel Andrusyshyn).


##Описание

Плагин служит разграничителем шаблонов для обычной(```<normal>```), мобильной(```<mobile>```) и особой(```<blind>```) версии сайта.

##Пример

```
<normal>
	<p>You use PC</p>
	[[$chunk_for_normal]]
</normal>
<mobile>
	<p>You use mobile</p>
	[[$chunk_for_mobile]]
</mobile>
<blind>
	<p>You see blind version</p>
	[[$chunk_for_blind]]
</blind>
```

Не проверял, но [говорят](https://modx.pro/help/4408/) при большом контенте показывается белый лист, Николай Загумённов решил это как-то так:
```
<normal>
	[[!$[[!#COOKIE.ttTemplate:is=`normal`:or:is=``:or:if=`[[!#GET.theme]]`:is=`normal`:then=`normal.chunk`]]]]
</normal>
<mobile>
	[[!$[[!#COOKIE.ttTemplate:is=`mobile`:or:if=`[[!#GET.theme]]`:is=`mobile`:then=`mobile.chunk`]]]]
</mobile>
<blind>
	[[!$[[!#COOKIE.ttTemplate:is=`blind`:or:if=`[[!#GET.theme]]`:is=`blind`:then=`blind.chunk`]]]]
</blind>
```



##Алгоритм

1. Срабатывает системное событие ```OnWebPagePrerender```;
2. Проверяем есть ли GET запрос;
3. Если есть = выводим соответствующих тег, если нет идем дальше. При запросе ```?theme=detect```;
	* Это iPhone? Да = выводим ```<mobile>```, если нет выводим ```<normal>```;
	* Это iPad? Да = выводим ```<mobile>```, если нет выводим ```<normal>```;
	* Это другие телефоны? Да = выводим ```<mobile>```, если нет выводим ```<normal>```;
4. Проверяем есть ли кука;
5. Если есть = выводим соответствующих тег, если нет идем дальше;
6. Проверяем телифон ли это;
7. Если телефон = выводим ```<mobile>```, если нет выводим ```<normal>```;

При этом если ```$useCookie = 1```, то мы записываем в куки название тега, чтобы не переключался шаблон, если мы задаем его принудительно через GET запрос.

##Запросы

  - http://www.site.ru/?theme=detect
  - http://www.site.ru/?theme=normal
  - http://www.site.ru/?theme=mobile
  - http://www.site.ru/?theme=blind

##Параметры

Название					| По умолчанию			| Описание
----------------------------|-----------------------|----------------------------------------
**useCookie**					| 1			| Использовать cookie.
**nameCookie**					| ttTemplate			| Название cookie.
**normalTag**					| normal			| Тег стандартной версии.
**mobileTag**					| mobile			| Тег мобильной версии.
**blindTag**					| blind			| Тег версии для слабовидящих.
**variable**					| theme			| Имя переменной GET запроса.
**value_detect**					| detect			| Значение переменной GET запроса для определения показываемого тега.
**value_normal**					| normal			| Значение переменной GET запроса для normalTag.
**value_mobile**					| mobile			| Значение переменной GET запроса для mobileTag.
**value_blind**					| blind			| Значение переменной GET запроса для blindTag.
**ipad**					| 1			| Считать ipad телефоном.
**iphone**					| 1			| Считать iphone телефоном.
**otherMobile**					| 1			| Считать другие телефоны телефонами.


##Мобильный детектор

За обнаружение мобильного устройства отвечает функция ```$uao```, которая в свою очеред получает ответ true/false из [MobileESP](https://mobileesp.googlecode.com/svn/PHP/mdetect.php).
При необходимости можно расширить плагин для вывода определенным устрайствам определенный тег.