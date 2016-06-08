# README

Trinity Admin Bundle
====================

[![Coverage Status](https://coveralls.io/repos/github/modpreneur/trinity-admin/badge.svg?branch=master)](https://coveralls.io/github/modpreneur/trinity-admin?branch=master)
[![Build Status](https://travis-ci.org/modpreneur/trinity-admin.svg?branch=master)](https://travis-ci.org/modpreneur/trinity-admin)

For removing sidebar messages user has to have this right granted:
-ROLE_ADMIN_SIDEBAR_MSG_REMOVE
otherwise he will not see removing button.

In the application (Necktie/Venice) has to be route for path 'ajax_remove-sidebar-msg'.
This is called from JS, if none path exist button doesn't work.

## styles compilation
`npm install`
`npm run styles`



