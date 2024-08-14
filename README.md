# AutoTransfwdbot

Welcome to **AutoTransfwdbot**, a powerful and efficient Telegram bot designed to automatically translate and forward messages from one Telegram channel to another. Whether you're managing a multilingual community or need to keep different channels synchronized in various languages, AutoTransfwdbot has you covered.

## 🚀 Features

- **Automatic Translation**: Seamlessly translate messages between multiple languages.
- **Multi-Channel Support**: Effortlessly forward messages from one channel to multiple channels.
- **Easy Integration**: Built with Laravel, leveraging the power of PHP Artisan commands for smooth operation.
- **Customizable Workflows**: Tailor the bot's behavior to suit your specific needs with Laravel's flexibility.

## 🛠️ Installation

To get started with AutoTransfwdbot, simply clone the repository and set up your environment.

```bash
git clone https://github.com/reyazat/AutoTransfwdbot.git
cd AutoTransfwdbot
composer install
```

## 🔧 Usage

Once you've set up your environment, you can run the bot using the following Artisan command:

```bash
php artisan telegram:translate
```

This command will execute the translation and forwarding logic defined in the `TranslateTelegramMessage.php` file located in the `app/Console/Commands/` directory.

## 📄 License

AutoTransfwdbot is open-source software licensed under the [MIT license](LICENSE).

## 🤝 Contributing

Contributions are welcome! If you'd like to contribute, please fork the repository and use a feature branch. Pull requests are warmly appreciated.

## 🌟 Acknowledgments

A big thank you to everyone who has contributed to this project, and to the amazing Laravel community for their support and inspiration.
