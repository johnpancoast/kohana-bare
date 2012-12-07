Configs are stacked. Configs higher in the stack can override values lower in the stack.

The stack is like this.
* Hostname config directory `config/example.com/`. This is not required.
* One of the environment directories depending on the environment. Will load either `config/production/`, `config/staging/`, or `config/development/`.
* base config directory `config/base/`. General config values that apply to all environments.
* normal config directory `config/`. We won't use this since all of our config values will reside in one of the directories above. We just load the config/ directory for modules and such.
