kohana-bare
===========

This is my fork of [https://github.com/kohana/kohana](https://github.com/kohana/kohana). It's a stripped down version of Kohana including a custom directory structure and a modified bootstrap that adds flexibility for different environments. This *does not* include Kohana's core system directory or any modules since you can/should add those as submodules once you start an application. For Kohana's basic application, check out [https://github.com/kohana/kohana](https://github.com/kohana/kohana).

## Creating an application
* Clone this repo.
* Initialize the application. This entails removing the existing git repository, starting a fresh one, including any required submodules, and adding a copyright. You can either use the following script `./bin/initialize-application` or pick out the commands it runs and manually run the ones you want. Why remove the repository and start fresh you ask? Because this repository contains history from Kohana and my fork that is not relevant to your application. Your application should start from scratch as its own thing.
* Point your domain to the application/www/ directory, access your domain in a browser, and resolve any issues Kohana has.
* When you see all green, Kohana should be good and you can remove application/www/install.php. Refreshing your browser will give you a hello world.
* By my convention, controllers that are touched *directly* from a request live in the application/classes/Controller/Public/ directory. This is to differentiate between controller classes that are actual controllers and controller classes that are related but not handling a request directly (parent classes of public classes are not hit directly ad thus not required to live in this directory).
* For further info, consult Kohana's [http://kohanaframework.org/documentation](documentation).

## Developing on my fork
* Clone this repo
* Create a file in the base directory called `.framework-dev`. This will allow you to not have to delete the install.php file from the repository to get a functioning application.
