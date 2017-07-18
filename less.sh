#!/usr/bin/env bash

node_modules/less/bin/lessc --clean-css src/AdminBundle/Resources/Public/less/admin.less src/AdminBundle/Resources/Public/css/admin.css
node_modules/less/bin/lessc --clean-css src/AdminBundle/Resources/Public/less/error.less src/AdminBundle/Resources/Public/css/error.css
