# Individual Project Assignment for the PHP MVC Frameworks Course @ SoftUni

Design and implement a **Shopping cart** using **PHP (Symfony)** and **HTML / CSS / JavaScript**. Your project must meet all the requirements listed below

## Requirements

### **Use PHP** – the major part of your work should be PHP written
* You **must use Symfony Framework**
* You have to additionally use **HTML5, CSS3** to create the content and to stylize your web application
* You may optionally use **JavaScript, jQuery, Bootstrap**
* Use **PHP 7+**

### **User source control system**
* **Use GitHub** or other source control system as project collaboration platform and commit your daily work

### **Valid and high-quality PHP, HTML and CSS**
* Follow the best practices for PHP development: http://www.phptherightway.com, https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md, http://symfony.com/doc/current/best_practices/index.html 
* Validate (when possible) your HTML (http://validator.w3.org) and CSS code (http://css-validator.org)
* Follow the best practices for **high-quality PHP, HTML and CSS**: good formatting, good code structure, consistent naming etc.

### **Usability, UX and browser support**
* Your web application should be easy-to-use, with intuitive UI, with good usability (usability != beauty)
* Ensure your web application works correctly in the latest HTML5-compatible browsers: Chrome, Firefox, IE, Opera, Safari (latest versions, desktop and mobile versions)
* You do not need to support old browsers like IE9

## Forbidden Techniques and Tools
* Using Shopping cart systems (like OpenCart) is forbidden.

## Shopping cart
**Required** functionalities:
* User registration / login and user profiles.
* User roles (user, administrator, editor)
* Initial cash for users
* Product categories
* Listing products in categories
* Add to cart functionality
* Promotions for certain time interval

	** Promotions on certain products (% discount)
	** Promotions on all products (% discount) 
	** Promotions on certain categories (% discount)
	** Promotions for certain user criteria (registered more than X days, have more than X cash, etc…)
	** If two or more promotions collide on a date period for certain product – the biggest one applies only
	
* Visibility only of available products
* Quantity visibility
* Checkout the cart
* View cart
* Users can sell bought products
* Editors can add/delete product categories
* Editors can add/delete products
* Editors can move products between categories
* Editors can change quantities
* Editors can reorder products
* Administrators have full access on products, categories, users and their possessions

## Bonus functionalities
* Managing the cart
* Users can sell products and put them promotions
* Users can make comments on products (review)
* Administrators: ban users
* Administrators: ban IP’s

# Build technologies:

## PHP
* **Symfony** framework
* **Twig** view engine
* **Doctrine** ORM
* **MySQL** database
