log_level                :info
log_location             STDOUT
node_name                'test-node-1'
chef_server_url          'http://127.0.0.1:8889'

client_key               File.expand_path('tests/key.pem')
syntax_check_cache_path  '~/.chef/syntax_check_cache'
cookbook_path [ '~/.chef/chef-repo/cookbooks' ]
