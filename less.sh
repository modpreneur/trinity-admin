#!/usr/bin/env bash

node_modules/less/bin/lessc --clean-css AdminBundle/Resources/Public/less/admin.less AdminBundle/Resources/Public/css/admin.css
node_modules/less/bin/lessc --clean-css AdminBundle/Resources/Public/less/error.less AdminBundle/Resources/Public/css/error.css
