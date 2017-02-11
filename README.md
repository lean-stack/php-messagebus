# Lean PHP Messagebus #

> A Lean PHP Messagebus

## CommandBus Design

- A command can be any object
- The CommandBus handles a command via its handle method and returns nothing (void)
- The CommandBus is constructed with an array of ordered Middlewares
- A Middleware is any class implementing the interface
- A Middleware is invokeable
- A Middleware operates on the command and delegates to the next Middleware
- The CommandBus ensures all middlewares are called
