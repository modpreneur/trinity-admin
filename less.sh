#!/usr/bin/env bash

node_modules/less/bin/lessc --clean-css AdminBundle/Resources/Public/less/admin.less AdminBundle/Resources/Public/css/admin.css
node_modules/less/bin/lessc --clean-css AdminBundle/Resources/Public/less/theme/brown.less AdminBundle/Resources/Public/css/theme/brown.css
node_modules/less/bin/lessc --clean-css AdminBundle/Resources/Public/less/theme/dark-blue.less AdminBundle/Resources/Public/css/theme/dark-blue.css
node_modules/less/bin/lessc --clean-css AdminBundle/Resources/Public/less/error.less AdminBundle/Resources/Public/css/error.css
