# Lean PHP Messagebus #

> A Lean PHP Messagebus (just a demo for my trainings)

## CommandBus Design

### Middleware
- A Middleware is any class implementing the interface
- A Middleware is invokeable
- A Middleware operates on a message and delegates to the next Middleware

### Command
- A command can be any object

### CommandBus
- The CommandBus handles a command via its handle method and returns nothing (void)
- The CommandBus is constructed with an array of ordered Middlewares
- The CommandBus ensures all middlewares are called

### CommandHandler
- A CommandHandler can be any callable
- The CommandHandler accepts the command

### CommandHandlerMiddleware
- The CommandhandlerMiddleware *makes* the CommandBus
- The CommandHandlerMiddleware delegates a command to its handler
- The CommandHandler uses a HandlerResolver to determine the handler for a given command

### HandlerResolver
- A HandlerResolver is any class implementing the interface
- A HandlerResolver determines the command handler for a given command

### CommandNameResolver
- A CommandNameResolver is any class implementing the interface
- A CommandName determines the name of a given command
