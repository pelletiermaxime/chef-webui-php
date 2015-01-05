namespace :deploy do

  %w(optimize migrate cache_clear).each do |command|
    desc '#Run artisan:{command}.'
    task command do
      command.sub!('_', ':')
      on roles 'app' do
        within release_path do
          execute :php, :artisan, command, fetch(:laravel_artisan_flags)
        end
      end
    end
  end

  after :updated, 'deploy:copy_files'
  # after :updated, 'deploy:migrate'
  after :updated, 'deploy:optimize'
  after :updated, 'deploy:set_permissions:acl'
  after :updated, 'deploy:cache_clear'
end
