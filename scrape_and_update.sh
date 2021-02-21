#!/bin/sh
cd ~/cron_projects/data_covid_vaccine
php get_vaccine_data.php
git diff --quiet || (php generate_graph.php && git add . && git commit -m "data updated" && git push && php tweet_update.php)