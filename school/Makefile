all:
	rake assets:precompile RAILS_ENV=production
	rake assets:index RAILS_ENV=production
clean:
	rm -rf public/assets
	rm public/index.html