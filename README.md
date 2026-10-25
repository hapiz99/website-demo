# Iron Pulse

Iron Pulse is a responsive gym and fitness center website template.

## Project structure

- `index.html` — website markup
- `css/style.css` — custom styles
- `js/main.js` — navigation and contact form behavior
- `contact.php` — validates contact form submissions and sends email to `hello@ironpulse.fit`
- `images/` — locally stored Unsplash photos

## Run locally

The contact form requires a PHP-enabled web server; opening `index.html` directly will not run the PHP endpoint. From the project directory, start PHP's built-in development server:

```sh
php -S localhost:8000
```

Then open <http://localhost:8000> in a browser. Configure PHP's `mail()` transport on the host for contact form email delivery.

## Use the contact form

1. Start the site using the PHP-enabled server described above and open it in your browser.
2. Scroll to the **Get in touch** section.
3. Enter your full name, a valid email address, and your message, then select **Send message**.
4. Wait for the on-page confirmation. If sending fails, the form displays an error so you can try again.

Messages are sent to `hello@ironpulse.fit`. Email delivery requires the server's PHP `mail()` transport to be configured; opening the HTML file directly or using a static-only host will not send messages.

## Credits

HTML template created and distributed by [TemplatesJungle.com](https://templatesjungle.com/).

Photography sourced from [Unsplash](https://unsplash.com/).
