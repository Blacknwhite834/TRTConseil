# TRTConseil

Technical Requirements
Before creating your first Symfony application you must:

Install PHP 8.1 or higher and these PHP extensions (which are installed and enabled by default in most PHP 8 installations): Ctype, iconv, PCRE, Session, SimpleXML, and Tokenizer;
Install Composer, which is used to install PHP packages.
Optionally, you can also install Symfony CLI. This creates a binary called symfony that provides all the tools you need to develop and run your Symfony application locally.

The symfony binary also provides a tool to check if your computer meets all requirements. Open your console terminal and run this command:

symfony check:requirements
The Symfony CLI is written in Go and you can contribute to it in the symfony-cli/symfony-cli GitHub repository.

Creating Symfony Applications
Open your console terminal and run any of these commands to create a new Symfony application:


symfony new my_project_directory --version="6.1.*" --webapp


symfony new my_project_directory --version="6.1.*"
The only difference between these two commands is the number of packages installed by default. The --webapp option installs all the packages that you usually need to build web applications, so the installation size will be bigger.

If you're not using the Symfony binary, run these commands to create the new Symfony application using Composer:


composer create-project symfony/skeleton:"6.1.*" my_project_directory
cd my_project_directory
composer require webapp


composer create-project symfony/skeleton:"6.1.*" my_project_directory
No matter which command you run to create the Symfony application. All of them will create a new my_project_directory/ directory, download some dependencies into it and even generate the basic directories and files you'll need to get started. In other words, your new application is ready!

The project's cache and logs directory (by default, <project>/var/cache/ and <project>/var/log/) must be writable by the web server. If you have any issue, read how to set up permissions for Symfony applications.

Setting up an Existing Symfony Project
In addition to creating new Symfony projects, you will also work on projects already created by other developers. In that case, you only need to get the project code and install the dependencies with Composer. Assuming your team uses Git, setup your project with the following commands:


cd projects/
git clone ...


cd my-project/
composer install
You'll probably also need to customize your .env file and do a few other project-specific tasks (e.g. creating a database). When working on a existing Symfony application for the first time, it may be useful to run this command which displays information about the project:

php bin/console about
Running Symfony Applications
In production, you should install a web server like Nginx or Apache and configure it to run Symfony. This method can also be used if you're not using the Symfony local web server for development.

However for local development, the most convenient way of running Symfony is by using the local web server provided by the symfony binary. This local server provides among other things support for HTTP/2, concurrent requests, TLS/SSL and automatic generation of security certificates.

Open your console terminal, move into your new project directory and start the local web server as follows:

cd my-project/
symfony server:start
Open your browser and navigate to http://localhost:8000/. If everything is working, you'll see a welcome page. Later, when you are finished working, stop the server by pressing Ctrl+C from your terminal.

The web server works with any PHP application, not only Symfony projects, so it's a very useful generic development tool.

Symfony Docker Integration
If you'd like to use Docker with Symfony, see Using Docker with Symfony

Installing Packages
A common practice when developing Symfony applications is to install packages (Symfony calls them bundles) that provide ready-to-use features. Packages usually require some setup before using them (editing some file to enable the bundle, creating some file to add some initial config, etc.)

Most of the time this setup can be automated and that's why Symfony includes Symfony Flex, a tool to simplify the installation/removal of packages in Symfony applications. Technically speaking, Symfony Flex is a Composer plugin that is installed by default when creating a new Symfony application and which automates the most common tasks of Symfony applications.

You can also add Symfony Flex to an existing project.

Symfony Flex modifies the behavior of the require, update, and remove Composer commands to provide advanced features. Consider the following example:

cd my-project/
composer require logger
If you run that command in a Symfony application which doesn't use Flex, you'll see a Composer error explaining that logger is not a valid package name. However, if the application has Symfony Flex installed, that command installs and enables all the packages needed to use the official Symfony logger.

This is possible because lots of Symfony packages/bundles define "recipes", which are a set of automated instructions to install and enable packages into Symfony applications. Flex keeps track of the recipes it installed in a symfony.lock file, which must be committed to your code repository.

Symfony Flex recipes are contributed by the community and they are stored in two public repositories:

Main recipe repository, is a curated list of recipes for high quality and maintained packages. Symfony Flex only looks in this repository by default.
Contrib recipe repository, contains all the recipes created by the community. All of them are guaranteed to work, but their associated packages could be unmaintained. Symfony Flex will ask your permission before installing any of these recipes.
Read the Symfony Recipes documentation to learn everything about how to create recipes for your own packages.

Symfony Packs
Sometimes a single feature requires installing several packages and bundles. Instead of installing them individually, Symfony provides packs, which are Composer metapackages that include several dependencies.

For example, to add debugging features in your application, you can run the composer require --dev debug command. This installs the symfony/debug-pack, which in turn installs several packages like symfony/debug-bundle, symfony/monolog-bundle, symfony/var-dumper, etc.

You won't see the symfony/debug-pack dependency in your composer.json, as Flex automatically unpacks the pack. This means that it only adds the real packages as dependencies (e.g. you will see a new symfony/var-dumper in require-dev). While it is not recommended, you can use the composer
require --no-unpack ... option to disable unpacking.

Checking Security Vulnerabilities
The symfony binary created when you install Symfony CLI provides a command to check whether your project's dependencies contain any known security vulnerability:

symfony check:security
A good security practice is to execute this command regularly to be able to update or replace compromised dependencies as soon as possible. The security check is done locally by fetching the public PHP security advisories database, so your composer.lock file is not sent on the network.

The check:security command terminates with a non-zero exit code if any of your dependencies is affected by a known security vulnerability. This way you can add it to your project build process and your continuous integration workflows to make them fail when there are vulnerabilities.

In continuous integration services you can check security vulnerabilities using a different stand-alone project called Local PHP Security Checker. This is the same project used internally by check:security but much smaller in size than the entire Symfony CLI.

Symfony LTS Versions
According to the Symfony release process, "long-term support" (or LTS for short) versions are published every two years. Check out the Symfony releases to know which is the latest LTS version.

By default, the command that creates new Symfony applications uses the latest stable version. If you want to use an LTS version, add the --version option:


symfony new my_project_directory --version=lts


symfony new my_project_directory --version=next


symfony new my_project_directory --version="5.4.*"
The lts and next shortcuts are only available when using Symfony to create new projects. If you use Composer, you need to tell the exact version:

composer create-project symfony/skeleton:"5.4.*" my_project_directory
