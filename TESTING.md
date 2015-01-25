Testing
=======

Acceptance tests (BDD) with Behat
---------------------------------

### Installation

You need Behat 3, Mink and the proper drivers. I personally like to have them installed globally via composer for my user and add "~/.composer/vendor/bin" to my PATH.

```json
{
    "require": {
        "behat/behat": "3.*"
        ,"behat/mink": "~1.6"
        ,"behat/mink-extension": "~2.0"
        ,"behat/mink-goutte-driver": "~1.1"
        ,"behat/mink-zombie-driver": "~1.2"
        ,"behat/mink-sahi-driver":  "~1.1"
        ,"behat/mink-selenium2-driver":  "~1.2"
    }
}
```

Next you need to install the stuff needed by the drivers.


### Drivers

I use Goutte and Selenium2 (for javascript). They are both really fast and easy to install, configure and use.

#### Goutte

It just works. By far the easiest to use and the fastest, but of course no javascript support.

#### Selenium

Download the selenium server on "http://docs.seleniumhq.org/download/". I also recommand the chrome backend on "http://chromedriver.storage.googleapis.com/index.html". Here's how to start it without and with the chrome driver.

```sh
java -jar selenium-server-*.jar
java -Dwebdriver.chrome.driver=./chromedriver -jar selenium-server-*.jar
```

Or you can just launch chromedriver directly, but it seems way slower for me. Maybe I'm doing it wrong ?

```sh
./chromedriver --port=4444 --url-base=wd/hub
```

#### Zombie

You need Zombie 2 for this: "npm install -g zombie". It didn't work on the buildin artisan server on port 8000.
I recommend using the latest version of node because 0.10 was incredibly slow for me, but it got a lot better with 0.11.
A few tests working in Selenium2 fail with weird error messages, so I don't recommend it yet.

#### Sahi

Somehow it was 5 times slower than Selenium2 when I tested it (https://github.com/Behat/MinkSahiDriver/issues/35), and was a PITA to install and configure. If you still want to try (hey, don't mind my opinions!) you can download the .jar installer on "http://sourceforge.net/projects/sahi/files/". I installed it in my home and then used "~/sahi/bin/dashboard.sh" to test it. The weird proxy also didn't work with my install on port 8000, but worked fine with localhost. You can use "sahi.sh" in the same directory to start just the server without the ugly Java dashboard.

### Usage

 * Uncomment Sahi or Zombie in behat.yml if you still want to use them after reading my installation instructions. Or just don't touch the file :P.
 * If a test fails, it will popup the rendered html before the error in "firefox".

#### Setup before running tests

```
php artisan serve &
bundle exec chef-zero -d
bundle exec berks update -b app/tests/Berksfile
BERKSHELF_CHEF_CONFIG="app/tests/client.rb" bundle exec berks upload --force -b app/tests/Berksfile
```

#### Test suites

 * Complete suite: `behat`
 * Only Gouttes tests (no js): `behat -p travisci`
 * Only domain tests: `behat -s domain`
