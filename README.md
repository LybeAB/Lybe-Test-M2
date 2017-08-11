# Lybe-Test-M2
Test framework

# Magento Codeception Tests

## Implemented Tests

* One Page Checkout

## Prerequisites

### Install 
sudo composer global require "codeception/codeception=2.1.*" "codeception/specify=*" "codeception/verify=*"

sudo ln -s ~/.composer/vendor/bin/codecept    /usr/local/bin/codecept


OR 

* Granted [HomeBrew](http://homebrew.sh) and [homebrew-php](https://github.com/Homebrew/homebrew-php#installation) are installed, execute:
    `brew install codeception`
* Selenium:
    `brew install selenium-server-standalone` and optionally `brew install chromedriver` if you want to test with Google Chrome
* PhantomJS:
    `brew install phantomjs`
    
## Configuration

* PhantomJS driver is a headless browser which means it's not suitable for browser environments like `chrome` or `firefox`
* Website URL to tests against is defined in acceptance.suite.yml

## Running tests

* Execute `selenium-server -p 4444` or `phantomjs --webdriver=4444 --ignore-ssl-errors=true` in a separate terminal tab
* Then execute `codecept run acceptance --steps`

See [Running Tests](http://codeception.com/docs/02-GettingStarted#Running-Tests) for detailed info

## Fork 
**https://github.com/Zifius/Magento-Codeception**