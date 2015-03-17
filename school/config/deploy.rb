# config valid only for current version of Capistrano
lock '3.3.5'

set :rvm_ruby_version, '2.2.0'
set :rvm_type, :system

hz_config = 
  {:name => "s30.vetov.ru",
   :domain => "s30.vetov.ru",
   :path => "school-30.ru",
   :gitname => "school30.git"}
   
set :application, hz_config[:name]

# GIT
set :scm, :git
set :repo_url, "git@github.com:servandserv/school30.git"
set :repo_tree, "school"
set :deploy_via, :remote_cache
set :git_shallow_clone, 1
set :copy_exclude, [".git", ".gitignore"]
set :keep_releases, 3

set :shared_children,   %w(log tmp/pids)

# Deploy to & branch
set :deploy_to, "/home/webmaster/#{hz_config[:path]}/rails"
set :branch, "master"

# Path settings
set :mongrel_conf, "#{current_path}/config/thin_cluster.yml"

# SSH and Network settings
set :pty, true
set :ssh_options, { :forward_agent => true, :port => '22' }
set :user, "webmaster"
set :use_sudo, false

set :linked_dirs, fetch(:linked_dirs, []).push('bin', 'log', 'tmp/pids', 'tmp/cache', 'tmp/sockets', 'vendor/bundle', 'public/system')

task :copy_configs do
  on roles(:all) do
    execute "cp #{shared_path}/config/database.yml #{release_path}/config"
    execute "cp #{shared_path}/config/thin_cluster.yml #{release_path}/config"
    execute "cp #{shared_path}/config/secrets.yml #{release_path}/config"
  end
end
after "deploy:updated", :copy_configs
before "deploy:assets:precompile", :copy_configs

after "deploy:updated", "deploy:cleanup"

namespace :deploy do
  COMMANDS = %w(start stop restart)

  COMMANDS.each do |command|
    task command do
      on roles(:app), in: :sequence, wait: 5 do
        within current_path do
          execute :bundle, "exec thin #{command} -C #{fetch :mongrel_conf} #{command == 'restart' ? '--onebyone' : ''}"
        end
      end
    end
  end

  # RVM integration
  if Gem::Specification::find_all_by_name('capistrano-rvm').any?
    COMMANDS.each { |c| before c, 'rvm:hook' }
  end
end

after 'deploy:publishing', 'deploy:restart'

if ENV['assets'] == 'no'
  puts 'NO assets!'
  namespace :deploy do
    namespace :assets do
      task :precompile, :except => { :no_release => true } do
        logger.info "Skipping asset pre-compilation because there were no asset changes"
      end
    end
  end
end