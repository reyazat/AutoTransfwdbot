# AutoTransfwdbot Power by AI

**AutoTransfwdbot** is a Telegram bot designed to seamlessly manage your channels by automatically translating and forwarding messages from one channel to another in real-time. Perfect for handling multilingual communities and keeping channels in sync, this bot is built to run continuously, ensuring that messages are always up-to-date.

## 🚀 Key Features

- **Live Translation and Forwarding**: Automatically translates and forwards messages in real-time across your Telegram channels.
- **Multi-Language Support**: Handles multiple languages, making it ideal for global communities.
- **ChatGPT Integration**: Offers enhanced, context-aware translations by integrating with ChatGPT.
- **Continuous Operation**: Designed to run persistently, providing uninterrupted service.
- **Built with Laravel**: Leverages Laravel’s powerful framework for ease of customization and deployment.

## 🛠️ Installation

To get started with AutoTransfwdbot, follow these steps:

1. **Clone the Repository:**

    ```bash
    git clone https://github.com/reyazat/AutoTransfwdbot.git
    cd AutoTransfwdbot
    ```

2. **Install Dependencies:**

    ```bash
    composer install
    ```

3. **Set Up Environment Variables:**
   Configure your `.env` file with the necessary API keys and settings, including your Telegram bot token and any translation API keys.

## 🔧 Usage

AutoTransfwdbot is designed to run continuously in the console. This ensures that the bot operates live, translating and forwarding messages in real-time.

### Running the Bot Continuously

To keep the bot running live, you can use a process manager like `Supervisor`, `systemd`, or simply run it in the background using `nohup` or `screen`. Here’s an example using `nohup`:

```bash
nohup php artisan telegram:translate > bot.log 2>&1 &
```

This command will:

- Run the bot in the background.
- Redirect all output to `bot.log`.
- Continue running even if you log out.

### 📢 ChatGPT Integration

Enhance the bot’s translation capabilities by integrating ChatGPT. To do this:

1. **Uncomment ChatGPT Integration:**
   In the `TranslateTelegramMessage.php` file, uncomment the ChatGPT integration code between lines 52 to 68.

   ```php
   // Uncomment these lines to enable ChatGPT translation
   $chatgpt_translation = $this->translateWithChatGPT($message);
   if ($chatgpt_translation) {
       $translated_message = $chatgpt_translation;
   }
   ```

2. **Comment Out Current Translation Tool:**
   Comment out the current translation tool to switch to ChatGPT.

   ```php
   // Comment out the current translation tool
   // $translated_message = $this->currentTranslationTool($message);
   ```

3. **Restart the Bot:**
   After making these changes, restart the bot to apply the ChatGPT integration.

   ```bash
   nohup php artisan telegram:translate > bot.log 2>&1 &
   ```

### 🔄 Current Translation Tool

By default, AutoTransfwdbot uses a specific translation tool (e.g., Google Translate API, Microsoft Translator, etc.). Switching to ChatGPT provides more natural translations and greater context awareness.


## 🤝 Contributing

We welcome contributions! If you would like to contribute, please fork the repository, create a new branch, and submit a pull request. Your contributions help improve AutoTransfwdbot for everyone.

## 🌟 Acknowledgments

Thank you to all contributors and the Laravel community for their support. Special thanks to OpenAI for ChatGPT, which powers the bot’s advanced translation capabilities.
