module.exports = {
  corePlugins: {
//    preflight: false,
  },
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './public/js/*.js',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    fontFamily: {
      body: [
        '"M PLUS Rounded 1c"',
        'sans-serif'
      ],
      title: [
        '"Kosugi Maru"',
        'sans-serif'
      ]
    },
    minWidth: {
      '0': '0',
      '1/4': '25%',
      '1/2': '50%',
      '3/4': '75%',
      'full': '100%',
      '1' : '0.25rem',
      '2' : '0.5rem',
      '3' : '0.75rem',
      '4' : '1rem',
      '5' : '1.25rem',
      '6' : '1.5rem',
      '8' : '2rem',
      '10' : '2.5rem',
      '12' : '3rem',
      '16' : '4rem',
      '20' : '5rem',
      '24' : '6rem',
      '32' : '8rem',
      '40' : '10rem',
      '48' : '12rem',
      '56' : '14rem',
      '64' : '16rem',
    },
    minHeight: {
      '0': '0',
      '1/4': '25%',
      '1/2': '50%',
      '3/4': '75%',
      'full': '100%',
      '1' : '0.25rem',
      '2' : '0.5rem',
      '3' : '0.75rem',
      '4' : '1rem',
      '5' : '1.25rem',
      '6' : '1.5rem',
      '8' : '2rem',
      '10' : '2.5rem',
      '12' : '3rem',
      '16' : '4rem',
      '20' : '5rem',
      '24' : '6rem',
      '32' : '8rem',
      '40' : '10rem',
      '48' : '12rem',
      '56' : '14rem',
      '64' : '16rem',
    },
    extend: {
      zIndex: {
        '1' : 1,
        '2' : 2,
        '3' : 3,
        '5' : 5,
        '11' : 11,
        '-1' : '-1',
      },
      rotate: {
        '30' : '30deg',
        '-30' : '-30deg',
      },
      neumorphismSize: {
        xs: '0.05em',
        sm: '0.1em',
        default: '0.2em',
        lg: '0.4em',
        xl: '0.8em',
      },
      colors: {
        tomato: {
          '50':  '#fbf7f3',
          '100': '#fcede5',
          '200': '#fad7c9',
          '300': '#f8b799',
          '400': '#f8885b',
          '500': '#ff6347',//main
          '600': '#f13c21',
          '700': '#d42d22',
          '800': '#ab2524',
          '900': '#8b1f20',
        },
        lettuce: {
          '50':  '#fafaf5',
          '100': '#f7f9df',
          '200': '#eef2a8',
          '300': '#d1de4c',//main
          '400': '#b8cc25',
          '500': '#88af0d',
          '600': '#628d07',
          '700': '#4d6d0a',
          '800': '#3c510f',
          '900': '#2f3f10',
        },
        chocolate: {
          '50':  '#fbfaf6',
          '100': '#fbf5e8',
          '200': '#f6e7c6',
          '300': '#f1d091',
          '400': '#eaa84d',
          '500': '#e28024',
          '600': '#c85a15',
          '700': '#994317',//main:resembles to coffee:#7B5544
          '800': '#6f331a',
          '900': '#542919',
        },
        ivory: {
          '50':  '#f8f8f5',
          '100': '#f5f3ea',
          '200': '#f1efdd',//main
          '300': '#dfd3ab',
          '400': '#c7b173',
          '500': '#ae8c47',
          '600': '#8e6731',
          '700': '#6f4f2f',
          '800': '#563d2d',
          '900': '#443228',
        },
        sepia: {
          '50':  '#fafbf9',
          '100': '#f8f7f2',
          '200': '#efebde',
          '300': '#e4d6bf',
          '400': '#cfb08a',
          '500': '#b38855',
          '600': '#896136',
          '700': '#624a2e',
          '800': '#443322',//main
          '900': '#342c23',
        },
        cerulean: {
          '50':  '#f0f8f9',
          '100': '#def5f6',
          '200': '#bbeff9',//main
          '300': '#8adbe7',
          '400': '#46c1db',
          '500': '#1f9fcc',
          '600': '#197eb5',
          '700': '#1e6393',
          '800': '#1e4d70',
          '900': '#1a3f58',
        },
        blush: {
          '50':  '#f9f8f7',
          '100': '#f8f1f1',
          '200': '#f1dee2',
          '300': '#ffc1c1',//main
          '400': '#e199a8',
          '500': '#d86e82',
          '600': '#bd4b61',
          '700': '#913950',
          '800': '#6d2d42',
          '900': '#542636',
        },
      },
      keyframes: {
        rotate: {
          'from': {transform: 'rotate(0deg)'},
          'to': {transform: 'rotate(360deg)'},
        }
      },
      animation: {
        'rotate-12steps': 'rotate 0.5s steps(12) infinite',
      },
    },
    linearGradientDirections: { // defaults to these values
      't': 'to top',
      'tr': 'to top right',
      'r': 'to right',
      'br': 'to bottom right',
      'b': 'to bottom',
      'bl': 'to bottom left',
      'l': 'to left',
      'tl': 'to top left',
    },
    linearGradientColors: { // defaults to {}
      'red': '#f00',
      'red-blue': ['#f00', '#00f'],
      'red-green-blue': ['#f00', '#0f0', '#00f'],
      'black-white-with-stops': ['#000', '#000 45%', '#fff 55%', '#fff'],
    },
    radialGradientShapes: { // defaults to this value
      'default': 'ellipse',
    },
    radialGradientSizes: { // defaults to this value
      'default': 'closest-side',
    },
    radialGradientPositions: { // defaults to these values
      'default': 'center',
      't': 'top',
      'tr': 'top right',
      'r': 'right',
      'br': 'bottom right',
      'b': 'bottom',
      'bl': 'bottom left',
      'l': 'left',
      'tl': 'top left',
    },
    radialGradientColors: { // defaults to {}
      'red': '#f00',
      'red-blue': ['#f00', '#00f'],
      'red-green-blue': ['#f00', '#0f0', '#00f'],
      'black-white-with-stops': ['#000', '#000 45%', '#fff 55%', '#fff'],
    },
    conicGradientStartingAngles: { // defaults to this value
      'default': '0',
    },
    conicGradientPositions: { // defaults to these values
      'default': 'center',
      't': 'top',
      'tr': 'top right',
      'r': 'right',
      'br': 'bottom right',
      'b': 'bottom',
      'bl': 'bottom left',
      'l': 'left',
      'tl': 'top left',
    },
    conicGradientColors: { // defaults to {}
      'red': '#f00',
      'red-blue': ['#f00', '#00f'],
      'red-green-blue': ['#f00', '#0f0', '#00f'],
      'checkerboard': ['white 90deg', 'black 90deg 180deg', 'white 180deg 270deg', 'black 270deg'],
    },
    repeatingLinearGradientDirections: theme => theme('linearGradientDirections'), // defaults to this value
    repeatingLinearGradientColors: theme => theme('linearGradientColors'), // defaults to {}
    repeatingLinearGradientLengths: { // defaults to {}
      'sm': '25px',
      'md': '50px',
      'lg': '100px',
    },
    repeatingRadialGradientShapes: theme => theme('radialGradientShapes'), // defaults to this value
    repeatingRadialGradientSizes: { // defaults to this value
      'default': 'farthest-corner',
    },
    repeatingRadialGradientPositions: theme => theme('radialGradientPositions'), // defaults to this value
    repeatingRadialGradientColors: theme => theme('radialGradientColors'), // defaults to {}
    repeatingRadialGradientLengths: { // defaults to {}
      'sm': '25px',
      'md': '50px',
      'lg': '100px',
    },
    repeatingConicGradientStartingAngles: theme => theme('conicGradientStartingAngles'), // defaults to this value
    repeatingConicGradientPositions: theme => theme('conicGradientPositions'), // defaults to this value
    repeatingConicGradientColors: { // defaults to {}
      'red': '#f00',
      'red-blue': ['#f00', '#00f'],
      'red-green-blue': ['#f00', '#0f0', '#00f'],
      'starburst': ['white 0 5deg', 'blue 5deg'],
    },
    repeatingConicGradientLengths: { // defaults to {}
      'sm': '10deg',
      'md': '20deg',
      'lg': '40deg',
    },
  },
  variants: {
    neumorphismFlat: ['responsive', 'hover', 'active', 'focus'],
    neumorphismConcave: ['responsive', 'hover', 'active', 'focus'],
    neumorphismConvex: ['responsive', 'hover', 'active', 'focus'],
    neumorphismInset: ['responsive', 'hover', 'active', 'focus'],
    filters: ['responsive', 'hover', 'active', 'focus'],
    bgFilters: ['responsive', 'hover', 'active', 'focus'],
    backgroundImage: ['responsive'], // this is for the "bg-none" utility
    linearGradients: ['responsive'],
    radialGradients: ['responsive'],
    conicGradients: ['responsive'],
    repeatingLinearGradients: ['responsive'],
    repeatingRadialGradients: ['responsive'],
    repeatingConicGradients: ['responsive'],
    extend: {
    },
  },
  plugins: [
    require('tailwindcss-neumorphism'),
    require('tailwind-filter-utilities'),
    require('tailwindcss-gradients'),
  ],
}
