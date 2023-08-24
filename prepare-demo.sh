#!/bin/bash

# This script prepares the demo for deployment.

# get script dir
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

# force move Northwind.axp outside app folder
mv "$DIR/app/Northwind.axp" "$DIR/Northwind.axp"