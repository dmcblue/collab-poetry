# collab-poetry

## Setup

Copy `.env.template` to `.env` and fill in the values.

Check you have all the required dependencies:
Note: You can safely ignore a warning about NVM not being installed if you are
sure it's accessible from the command line.
```shell
opentask requirements list
opentask requirements test
```

Then run the [opentask](https://github.com/interealm-games/opentask) setup:
```shell
opentask rungroup init
```

You can see all the possible tasks with:
```shell
opentask list
```

## Development

You can build the current code with:
```shell
opentask rungroup build
```

Then, in a separate terminal, serve the site with:
```shell
opentask rungroup serve
```

## Tools Used (via CDN)

https://github.com/simonbengtsson/jsPDF-AutoTable

http://raw.githack.com/MrRio/jsPDF/master/docs/index.html
