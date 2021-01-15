#!/bin/sh
php get_vaccine_data.php
git diff --quiet || (git add . && git commit -m "data updated" && git push)