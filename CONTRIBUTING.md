# CONTRIBUTING

I' m always happy if somebody wants to help me out with this project and contribute to it.

But in order to keep this repo clean and sleek there are some guidelines:

## PSR

This project is following the PSR-0, PSR-1 and PSR-2 standards.


## How to do a pull request

First open an issue on GitHub with ```[Proposal]``` in the title with a brief explanation and implementation ideas.
I' ll aprove or decline the idea. If it' s get approved you may go ahead and submit a pull request. If you don' t follow this process your pull request will get dropped.

### Branch

All PR should go into the ```develop``` branch. PR to the ```master``` will get dropped (the may get merged if they are documentation and comments changes only)

## Aditional coding conventions

The ```namespace``` declaration should go into the same line as the php opening tag:

    <?php namespace Foo;
    // ...

After control structures' (e.g. ```if```, ```foreach```) should be an empty line or a comment which explaines the structure.
There should be a blank line after the last statement within the control structure:

    if ($foo === true) {

      echo 'Bar';
    
    }
    
    // or...
    if ($foo === true) {
      //Comment or empty line
      echo 'Bar';
    
    }

### Classes

An abstract class should be prefixed with ```Abstract``` (e.g. ```AbstractFoo```).

An interface should be suffixed with ```Interface``` (e.g ```FooInterface```).

## CI

This repos is tested with the CI server Travis-ci. A build can be skiped with the keyword ```[ci skip]```.

This keyword should go at the end of the main commit message line. It' s only allowed to be used if the commit changes static text/markdown files only.
If logic code is changed a build is necessary.


## Conclusion

If a pull request doesn' t full-fill these requirements I' ll kindly note it and give 168h (7 days) to fix it, if the violations has been fixed I' ll consider merging it.

Otherwise I' ll close it silently.