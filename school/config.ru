# This file is used by Rack-based servers to start the application.

require ::File.expand_path('../config/environment',  __FILE__)

require 'rack/reverse_proxy'

use Rack::ReverseProxy do
  reverse_proxy /^\/api\/?(.*)$/, 'http://www.school-30.com/api/$1'
end

run Rails.application
