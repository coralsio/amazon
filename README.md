# Corals Amazon
Amazon Module is an addon for Laraship eCommerce that gives you the ability to import products from Amazon and sell them as affiliate products, you can filter products by keywords and categories with other importing options. the import will extract the following:

1.Product Attributes: title, description, price, Amazon URL, and ASIN

2.the reviews iframe

3.Product Images

4.Brand

5.Categories

6.Tags


Amazon Module Manager is using Product Advertising API to connect to Amazon to pull the products from Amazon.

p>&nbsp;</p>

### How To Get Your Access Key ID & Secret Key
Getting your Access Key ID and Secret Key pair is easy enough, but it involves a number of steps.

<strong>1) Goto the Amazon Associates Program home page and login to your account. For the purposes of this tutorial, we assume you are already an approved Amazon affiliate.</strong>

https://affiliate-program.amazon.com

<strong>2) Click on the Product Advertising API link at the top of the page:</strong>


<p><img src="https://www.laraship.com/wp-content/uploads/2018/06/larave-product-advertising-api-1.png" alt=""></p>


<strong>3) Click the button to access/signup. Log in to your Amazon login or follow the prompts to create your Product Advertising API account.</strong>

<p><img src="https://www.laraship.com/wp-content/uploads/2018/06/larave-product-advertising-api-2.png" alt=""></p>
p>&nbsp;</p>

<strong>4) If you get a prompt on the next screen, click on Continue to Security Credentials. DO NOT USE IAM USERS – Amazon’s Product Advertising API must use the parent keys, not user keys.</strong>


<p><img src="https://www.laraship.com/wp-content/uploads/2018/06/larave-product-advertising-api-3.png" alt=""></p>
p>&nbsp;</p>

<strong>5) Expand the “Access Keys” section. This section contains all of your current access keys. You will likely need to make a new one (you can have 2 active key pairs per account). Feel free to use an existing one if you have the secret key already, otherwise click on the Create New Access Key button.</strong>


<p><img src="https://www.laraship.com/wp-content/uploads/2018/06/larave-product-advertising-api-4.png" alt=""></p>
p>&nbsp;</p>

<strong>6) A dialog box will appear with your new Access Key and Secret Key. Copy these into the ThirstyAffiliates->Settings page under the Amazon Importer settings tab.</strong>

We also recommend clicking the Download Key File button and storing this in a secure location, like a password manager as you cannot retrieve the Secret Key from an existing Access Key after you click Close. Make sure you have it otherwise you will need to de-activate an old key and create another new one.

p>&nbsp;</p>
<p><img src="https://www.laraship.com/wp-content/uploads/2018/06/larave-product-advertising-api-5.jpg" alt=""></p>
p>&nbsp;</p>

Your keys should look something like this:

- Access key ID example: AKIAIOSFODNN7EXAMPLE

- Secret access key example: wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY

p>&nbsp;</p>

### How To Get Your Amazon Associate Tag
The associate tag can be found under your amazon affiliate at the top right, as in the screenshot below

<p><img src="https://www.laraship.com/wp-content/uploads/2018/06/amazon-setting-associate-atgss.png" alt=""></p>
p>&nbsp;</p>


### Now You can enter all these details to Amazon Plugin settings.

<p><img src="https://www.laraship.com/wp-content/uploads/2018/06/amazon-settings.png" alt=""></p>
p>&nbsp;</p>


### Setup Your Cron Job:
Amazon Importer uses background processes extract imports to avoid any timeout memory issues, jobs will be queued and the importer process will import only one job at the time, to set up your importer scheduler you need to add the following command to your crontab

```php
php artisan  import:run
```

<p>&nbsp;</p>


## Installation

You can install the package via composer:

```bash
composer require corals/amazon
```

## Testing

```bash
vendor/bin/phpunit vendor/corals/amazon/tests 
```
