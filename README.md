# Online Shop

## Yii2 Basic 2.015 [ PHP 7.2 | HTML5 | Bootstrap 4.0 ] 

INFO
-------------------
> Possibility to buy products from registration and without
> Registration via SMS confirmation
> Payment with Payme and Click payment system

ADMIN
-------------------
~~~
http://site.com/admin
~~~
 File 
~~~
@app/modules/admin
~~~

INSTALLATION
------------
* Update dependencies with Composer 
```
 composer update
```
 
* Migrate user table 
```
 yii migrate
```

### Extensions

```
    "require": {
    	...
        "yiisoft/yii2-swiftmailer": "~2.0.0",		
        "mdmsoft/yii2-admin": "~2.0",
        "unclead/yii2-multiple-input": "~2.0",
        "mihaildev/yii2-elfinder": "*",
        "mihaildev/yii2-ckeditor": "*",
        "trntv/yii2-file-kit": "^1.3",
        "kartik-v/yii2-widget-colorinput": "*",
        "kartik-v/yii2-export": "@dev",
        "kartik-v/yii2-mpdf": "dev-master"

    }
```


* Change files 
 1. Paycom  - Payme API - Merchant ID and KEY [payme.uz](http://payme.uz)
 2. Click   - ClickUz API - Merchant ID and Key [click.uz](http://click.uz)
 3. SMS 	- GETSMS API - Lgin and Password [getsms.uz](http://getsms.uz)




