##### *Note that this is my fork of [Kohana](https://github.com/kohana/kohana) which includes the following custom custom changes I've made.*
- *The codebase does not live in the web root.*
- *The bootstrap includes different files and configs based on the environment. This allows for more diversity between environments.
- *Various bootstrap values are now located in (and loaded from) configs.*
- *By my convention, public facing controller classes live in application/classes/Controller/Public/. Public facing means controllers that are actually "touched" by a request. Public facing does not have to include classes that are extended that handle a request for a child class that was actually hit. This allows us to keep controller related classes and controllers separate.*
- *Contains classes that are reusable amongst my applications but perhaps do not yet belong in a standalone module although that should be rare.*
- *The rest of Kohana should be the same...*

##### *Starting an application*
- *Clone it.*
- *Point your web server to the application/www/ directory.*
- *Access your site in your browser and address any installation needs.*
- *When you get all green, remove application/www/install.php and refresh.*
- *Update your git submodules using `git submodules update --init --recursive`.*
- *Further details can be found in Kohana's documentation.*

##### *Developing on my fork*
- *Clone it.*
- *Create a file called `.framework-dev` in the base directory. This avoids having to remove the application/www/install.php file that should stay in the repository.*
- *Further details can be found in Kohana's documentation.*

# Kohana PHP Framework

[Kohana](http://kohanaframework.org/) is an elegant, open source, and object oriented HMVC framework built using PHP5, by a team of volunteers. It aims to be swift, secure, and small.

Released under a [BSD license](http://kohanaframework.org/license), Kohana can be used legally for any open source, commercial, or personal project.

## Documentation
Kohana's documentation can be found at <http://kohanaframework.org/documentation> which also contains an API browser.

The `userguide` module included in all Kohana releases also allows you to view the documentation locally. Once the `userguide` module is enabled in the bootstrap, it is accessible from your site via `/index.php/guide` (or just `/guide` if you are rewriting your URLs).

## Reporting bugs
If you've stumbled across a bug, please help us out by [reporting the bug](http://dev.kohanaframework.org/projects/kohana3/) you have found. Simply log in or register and submit a new issue, leaving as much information about the bug as possible, e.g.

* Steps to reproduce
* Expected result
* Actual result

This will help us to fix the bug as quickly as possible, and if you'd like to fix it yourself feel free to [fork us on GitHub](https://github.com/kohana) and submit a pull request!
