/* eslint-disable */
const path                  = require( 'path' ),
  MiniCssExtractPlugin      = require( 'mini-css-extract-plugin' ),
  UglifyJSPlugin            = require( 'uglifyjs-webpack-plugin' ),
  OptimizeCssAssetsPlugin   = require( 'optimize-css-assets-webpack-plugin' ),
  BrowserSyncPlugin         = require( 'browser-sync-webpack-plugin' ),
  StyleLintPlugin           = require( 'stylelint-webpack-plugin' ),
  SpriteLoaderPlugin        = require( 'svg-sprite-loader/plugin' ),
  FixStyleOnlyEntriesPlugin = require( 'webpack-fix-style-only-entries' );
/* eslint-enable */

const config = {
  context: __dirname, // eslint-disable-line
  entry: {
    customizer: [ './src/js/customizer.js' ],
    editor: [ './src/scss/editor.scss' ],
    error: [ './src/js/error.js', './src/scss/error.scss' ],
    home: [ './src/js/home.js', './src/scss/home.scss' ],
    index: [ './src/js/index.js', './src/scss/index.scss' ],
    page: [ './src/js/page.js', './src/scss/page.scss' ],
    search: [ './src/js/search.js', './src/scss/search.scss' ],
    single: [ './src/js/single.js', './src/scss/single.scss' ]
  },
  output: {
    path: path.resolve( __dirname, 'dist' ), // eslint-disable-line
    filename: '[name].js'
  },
  resolve: {
    extensions: [ '.js', '.jsx', '.scss', '.css', '.json' ]
  },
  mode: 'development',
  devtool: 'source-map',
  module: {
    rules: [
      {
        enforce: 'pre',
        exclude: /node_modules/,
        test: /\.jsx$/,
        loader: 'eslint-loader'
      },
      {
        test: /\.jsx?$/,
        loader: 'babel-loader',
      },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              indent: 'postcss',
              plugins: [
                /* eslint-disable */
                require( 'autoprefixer' )( { browsers: 'last 2 versions' } ),
                require( 'css-mqpacker' )( { sort: true } ),
                require( 'postcss-unit-conversion' )( {
                  base: 16,
                  precision: 3,
                  toEM: [
                      'letter-spacing',
                      'text-shadow'
                  ],
                  toREM: [
                      'box-shadow',
                      'font-size',
                      'margin',
                      'padding'
                  ]
              } )
              /* eslint-enable */
              ]
            }
          },
          {
            loader: 'sass-loader'
          }
        ]
      },
      {
        test: /\.svg$/,
        loader: 'svg-sprite-loader',
        options: {
          extract: true,
          spriteFilename: 'svg-defs.svg'
        }
      },
      {
        test: /\.(jpe?g|png|gif)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              outputPath: 'images/',
              name: '[name].[ext]'
            }
          },
          'img-loader'
        ]
      }
    ]
  },
  plugins: [
    new StyleLintPlugin(),
    new FixStyleOnlyEntriesPlugin(),
    new MiniCssExtractPlugin( { filename: '[name].css' } ),
    new SpriteLoaderPlugin(),
    new BrowserSyncPlugin( {
      files: [
        '**/*.php',
        'src/**/*.js',
        'src/**/*.scss'
      ],
      injectChanges: true,
      proxy: 'https://acorn.test'
    } )
  ],
  optimization: {
    minimizer: [ new UglifyJSPlugin(), new OptimizeCssAssetsPlugin() ]
  }
};

// Check if build is running in production mode, then change the sourcemap type
if ( 'production' === process.env.NODE_ENV ) { // eslint-disable-line
  config.devtool = ''; // No sourcemap for production
  config.mode = 'production';
}

module.exports = config; // eslint-disable-line
