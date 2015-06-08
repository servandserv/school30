require 'render_anywhere'

class RenderIndex
  include RenderAnywhere

  def build_html
    html = render :template => 'index/index',
                  :layout => 'application'
    html
  end
end

namespace :assets do
  desc "Генерирует index.html для публикации"
  task :index => :environment do
    if Rails.env != 'production'
      puts "Нужно запускать с RAILS_ENV = production"
    else
      x = RenderIndex.new
      File.open("public/index.html", 'w') do |f|
        f.write x.build_html
      end
    end
  end

  task :build => :environment do
    Rake::Task['assets:precompile'].invoke
    Rake::Task['assets:index'].invoke
  end
end