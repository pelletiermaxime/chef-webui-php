# config valid only for Capistrano 3.1
lock '3.3.5'

set :application, 'chefwebui'
set :repo_url, 'https://github.com/pelletiermaxime/chef-webui-php.git'

set :ssh_options, forward_agent: true, port: 36_220

set :deploy_to, '/var/www/chefwebui.pelletiermaxime.info'

set :linked_dirs, [
  'storage/logs',
  'storage/framework/cache',
  'storage/framework/sessions',
  'storage/framework/views'
]

set :linked_files, [
  '.env'
]

set :file_permissions_paths, [
  'storage',
  'storage/app',
  'storage/framework',
  'storage/framework/sessions',
  'storage/framework/views',
  'storage/logs'
]
set :file_permissions_users, ['www-data']

# Speed up composer by using a copy of previous vendor
set :copy_files, [
  'vendor'
]

namespace :deploy do
  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :touch, release_path.join('tmp/restart.txt')
    end
  end

  after :publishing, :restart

  after :restart, :clear_cache do
    on roles(:web), in: :groups, limit: 3, wait: 10 do
      # Here we can do anything such as:
      # within release_path do
      #   execute :rake, 'cache:clear'
      # end
    end
  end
end
