# config valid only for Capistrano 3.1
lock '3.2.1'

set :application, 'chefwebui'
set :repo_url, 'https://github.com/pelletiermaxime/chef-webui-php.git'

set :ssh_options, forward_agent: true, port: 36220

set :deploy_to, '/var/www/chefwebui.pelletiermaxime.info'

set :linked_dirs, [
  'app/storage/logs',
  'app/storage/sessions',
  'app/config/packages/jenssegers/chef'
]

set :linked_files, [
]

set :file_permissions_paths, [
  'app/storage',
  'app/storage/cache',
  'app/storage/logs',
  'app/storage/meta',
  'app/storage/sessions',
  'app/storage/views'
]
set :file_permissions_users, ['www-data']

# Speed up composer by using a copy of previous vendor
set :copy_files, [
  'composer.lock',
  'vendor'
]

# Default branch is :master
# ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }.call

# Default value for :format is :pretty
# set :format, :pretty

# Default value for :log_level is :debug
# set :log_level, :info

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
# set :keep_releases, 5

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
