# Inline Games [![License](https://img.shields.io/github/license/SkyBotsDeveloper/inlinexgamesbot.svg)](https://github.com/SkyBotsDeveloper/inlinexgamesbot/blob/master/LICENSE) [![Telegram](https://img.shields.io/badge/Telegram-%40inlinexgamesbot-blue.svg)](https://telegram.me/inlinexgamesbot)

A Telegram bot that provides real-time multiplayer games that can be played in any chat.

You can see the bot in action by messaging [@inlinexgamesbot](https://telegram.me/inlinexgamesbot).

The bot is currently hosted at [Heroku](https://www.heroku.com).

#### Currently available games:

- Tic-Tac-Toe
- Tic-Tac-Four ([@DO97](https://github.com/DO97))
- Elephant XO ([@DO97](https://github.com/DO97))
- Connect Four
- Rock-Paper-Scissors
- Rock-Paper-Scissors-Lizard-Spock ([@DO97](https://github.com/DO97))
- Russian Roulette
- Checkers
- Pool Checkers

## Deploying

### Heroku

<details>
  <summary>Instructions</summary>

Use this button to begin deployment:  
[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy?template=https://github.com/SkyBotsDeveloper/inlinexgamesbot)

- Make sure you deploy from the repository root (the folder that contains `composer.json` and `Procfile`).
- Set all required config vars: `BOT_TOKEN`, `BOT_USERNAME`, `BOT_WEBHOOK`, `BOT_SECRET`.
  - `BOT_WEBHOOK` should be full URL to your app, e.g. `https://YOURAPPNAME.herokuapp.com`
- The release phase runs `php bin/console post-install` automatically to initialize storage and set webhook.

Useful checks after deploy:
- `php bin/console info`
- `php bin/console set`

You will also want to add **Heroku Scheduler** addon and set up a hourly task to run the following command to clean up expired games from the database:
- `php bin/console cron`

_If this command times out too fast try using something like this instead: `php -d max_execution_time=2700 bin/console cron`_

Alternatively, scale a background worker dyno (`worker` process from `Procfile`) to run cleanup continuously.

</details>

### Google Cloud Platform

<details>
  <summary>Instructions</summary>

- Install dependencies with `composer install`
- Copy `env_variables.example.yaml` into `env_variables.yaml` and fill out the details
- Run the deployment command: `gcloud app deploy --project YOUR-PROJECT-NAME-HERE app.yaml cron.yaml`
- Visit `https://YOUR-PROJECT-NAME-HERE.appspot.com/admin?a=post-install` to perform post-install tasks

</details>

### Fly.io

<details>
  <summary>Instructions</summary>

- `flyctl apps create`
- `flyctl volumes create data --size=1`
- `flyctl secrets set BOT_TOKEN=`
- `flyctl secrets set BOT_USERNAME=`
- `flyctl secrets set BOT_WEBHOOK=YOUR-APP-NAME.fly.dev`
- `flyctl secrets set BOT_SECRET=`
- If you want to use web+worker setup you have to replace `web:` line in `Procfile`
- `flyctl deploy`

</details>

### DOM Cloud

<details>
  <summary>Instructions</summary>

- Copy `.env.example` into `.env` and fill out the details
- Upload `.env` and `crontab` to `/home/<your-website-name>/config` directory on the FTP
  - `crontab` will require modifications - use full paths to the script - e.g.: `/home/<your-website-name>/public_html/bin/console`
- Run this deployment task:
```
source: 'https://github.com/SkyBotsDeveloper/inlinexgamesbot'
commands:
  - 'test -f ../config/.env && cp -f ../config/.env .'
  - 'test -f ../config/config.php && cp -f ../config/config.php . || exit 0'
  - 'composer install --no-dev --optimize-autoloader --ignore-platform-reqs'
  - 'php bin/console install'
  - 'php bin/console set'
  - 'test -f ../config/crontab && cat ../config/crontab | crontab - || exit 0'
features:
  - ssl
  - 'php 7.4'
```

</details>

## Note on translations

Translations support is implemented but it is not used mainly because translated text would be displayed to both players - this could be problematic in "gaming" groups - people setting language that other player can't understand!

## Contributing

See [CONTRIBUTING](CONTRIBUTING.md) for more information.

## License

See [LICENSE](LICENSE).
