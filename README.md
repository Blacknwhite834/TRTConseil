# TRTConseil

Setting up an Existing Symfony Project :

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
