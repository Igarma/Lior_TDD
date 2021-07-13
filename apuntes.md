# Principis de la TDD " Test Driven Developement "

## Tipos de test   
- tests unitaris - unitats molt petites de programación
- tests d'integració - com interactuen diferents complements
- tests end to end (funcionals ) - com funcionaria pel usuari final


## Principis bàsics del TDD 
- no s'escriu ni uns línia  que no ho demani un test.
- No es fant nos tests fins que no passen tots els anteriors
- No es codifca res més enllà de lo necessari per que le test pasi.

## Estructura d'un test:
- Given $\rightarrow$ Donat un estat o condicions inicials.
- When  $\rightarrow$ Quan ·invoca una acció o perturvació del sistema.
- Then  $\rightarrow$ Esperem que passi ....

## Wishful Thinking 
Es una poderosa pràctica de programació: abans de implementar un component escribim una mica de codi que l'usi com si el complement ja existis. D'aquesta forma descobrim quines fucions i quons paràmentres necessitem realment. S'usa molt enl tdd per fer codi testable.

## eines
- vendor/bin/phpunit tests/ -- color
- vendor/bin/phpunit-watcher watch tests/ --color=always