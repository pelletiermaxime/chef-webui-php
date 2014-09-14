server 'pelletiermaxime.info', user: 'deploy', roles: %w(web app)

set :branch, 'master'

set :laravel_artisan_flags, '--env=production'
