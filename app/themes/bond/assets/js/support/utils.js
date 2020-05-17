//
// Utils
// --------------------------------------------------

import isEmpty from 'lodash/isEmpty'
import isArray from 'lodash/isArray'


// Images Loaded Util

function getAllImages(container)
{
  if (!container) {
    return []
  }

  let images = []

  if (isArray(container)) {
    for (const item of container) {
      images = images.concat(Array.from(item.getElementsByTagName('img')))
    }
  } else {
    images = Array.from(container.getElementsByTagName('img'))
  }

  return images
}

function onEveryImagesLoaded(container, callback, callIfNone) {
  let images = getAllImages(container)

  if (!images.length) {
    if (callIfNone) {
      callback()
    }
    return
  }

  images.forEach(image => {
    if (image.complete) {
      callback(image)
    } else {
      image.addEventListener('load', () => {
        callback(image)
      })
      image.addEventListener('error', () => {
        callback(image)
      })
    }
  })
}

function onAllImagesLoaded(container, callback, callIfNone) {
  let images = getAllImages(container)

  if (!images.length) {
    if (callIfNone) {
      callback(images)
    }
    return
  }

  let counter = images.length

  const done = () => {
    counter--
    if (counter <= 0) {
      callback(images)
    }
  }

  images.forEach(image => {
    if (image.complete) {
      done()
    } else {
      image.addEventListener('load', done)
      image.addEventListener('error', done)
    }
  })
}

// String utils

function initialLetters(string) {
  if (isEmpty(string)) {
    return ''
  }
  const names = string.split(' ')
  let initials = names[0].substring(0, 1)

  if (names.length > 1) {
    initials += names[names.length - 1].substring(0, 1)
  }
  return initials
}

function appendString(
  target,
  value,
  appendToTarget,
  appendBefore,
  appendAfter,
  fallback
) {
  [].concat(value).forEach(string => {
    string = returnStringIf(string, appendBefore, appendAfter, fallback)

    if (string) {
      if (target && appendToTarget) {
        target += appendToTarget
      }
      target += string
    }
  })
  return target
}

function prependString(
  target,
  value,
  prependToTarget,
  appendBefore,
  appendAfter,
  fallback
) {
  [].concat(value).forEach(string => {
    string = returnStringIf(string, appendBefore, appendAfter, fallback)

    if (string) {
      if (target && prependToTarget) {
        target = prependToTarget + target
      }
      target = string + target
    }
  })
  return target
}

function returnStringIf(string, appendBefore, appendAfter, fallback) {
  if (string) {
    return (appendBefore || '') + string + (appendAfter || '')
  }

  return fallback
}


// Baseline Grid & Guides

function createGrid(containerFluid) {
  let columns = 12
  let colSize = 'col-1'
  let containers

  if (window.IS_MOBILE) {
    columns = 2
    colSize = 'col-6'
  }

  if (containerFluid) {
    containers = document.getElementsByClassName('container-fluid')
  } else {
    containers = document.getElementsByClassName('container')
  }

  Array.from(containers).forEach(container => {
    // create and store elements in cache
    if (!container.cols) {
      // create html markup
      let cols = ''
      cols += '<hr class="control-baseline">'
      cols += '<div class="guides-baselines"></div>'

      let col = '<div class="'+colSize+'"><div class="guides-col"></div></div>'
      for (let i = 0; i < columns; i++) {
        cols += col
      }

      // create elements
      container.cols = document.createElement('div')
      container.cols.className = 'guides-row'
      container.cols.innerHTML = cols

      container.line = document.createElement('hr')
      container.line.className = 'guide-baseline hr1'

      // store references
      container.baselines = container.cols.getElementsByClassName(
        'guides-baselines'
      )[0]
      container.controlBaseline = container.cols.getElementsByClassName(
        'control-baseline'
      )[0]

      // add to dom
      container.appendChild(container.cols)
    }

    // update container height
    let containerHeight = container.offsetHeight
    container.cols.style.height = containerHeight + 'px'

    // // toggle hide/show
    if (!container.classList.contains('guides')) {
      container.classList.add('guides')

      // insert lines
      let lineHeight = container.controlBaseline.offsetHeight
      let n = Math.ceil(containerHeight / lineHeight)

      for (let j = 0; j < n; j++) {
        container.baselines.appendChild(container.line.cloneNode())
      }

      // body
      document.body.classList.add('baselines')
      //
      //
    } else {
      container.classList.remove('guides')

      // remove lines
      while (container.baselines.lastChild) {
        container.baselines.removeChild(container.baselines.lastChild)
      }

      // body
      document.body.classList.remove('baselines')
    }
  })


}




function init() {
  // Touch
  window.IS_TOUCH =
    'ontouchstart' in window ||
    (window.DocumentTouch && document instanceof DocumentTouch) // eslint-disable-line no-undef

  if (!window.IS_TOUCH) {
    document.body.classList.add('no-touch')
  }

  document.addEventListener('DOMContentLoaded', () => {
    if (document.readyState === 'interactive') {


      // Grid
      document.body.addEventListener('keydown', event => {
        if (event.which !== 87) {
          // w
          return
        }

        if (event.shiftKey && event.altKey) {
          createGrid(true)
        } else if (event.altKey) {
          createGrid()
        }
      })
    }
  })
}

export {
  init,
  appendString,
  prependString,
  onEveryImagesLoaded,
  onAllImagesLoaded,
  initialLetters
}
