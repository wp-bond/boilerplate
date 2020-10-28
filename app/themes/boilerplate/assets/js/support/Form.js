import axios from 'axios'
import Errors from './Errors'
import isEmpty from 'lodash/isEmpty'
import isObject from 'lodash/isObject'
import castArray from 'lodash/castArray'
import toString from 'lodash/toString'
import merge from 'lodash/merge'

const parseErrorMessages = error => {
  if (!error.response) {
    return ''
  }
  let data = error.response.data
  let errorMessages

  // if no data, get straigth from the error message
  if (isEmpty(data)) {
    errorMessages = error.message

    // if stricly set on 'message' property, honor that
  } else if (data.message) {
    errorMessages = data.message

    // if stricly set on 'error' property, honor that
  } else if (data.error) {
    errorMessages = data.error

    // use all properties as a source for error messages
  } else {
    errorMessages = data
  }

  // if is object, join all values
  if (isObject(errorMessages)) {
    let messages = []

    for (let field in errorMessages) {
      messages.push(castArray(errorMessages[field]).join(' / '))
    }

    return messages.join('<br>')
  }

  return toString(errorMessages)
}

class Form {
  /**
   * Create a new Form instance.
   */
  constructor(options) {
    this.errors = new Errors()
    this.onKeydown = this.onKeydown.bind(this)
    this.reset()

    if (options) {
      this.baseUrl = options.baseUrl

      if (!isEmpty(options.default) && isObject(options.default)) {
        this.default = options.default
      }
    }
  }

  reset() {
    this.baseUrl = ''
    this.processing = false
    this.dirty = false
    this.message = ''
    this.errorField = ''
    this.status = 'ready'
  }

  onKeydown(event) {
    this.dirty = true
    this.message = ''
    this.errors.clear(event.target.name)
  }

  submitDisabled() {
    return this.errors.any() || !this.dirty
  }

  /**
   * Send a GET request to the given URL.
   *
   * @param {string} url
   * @param {object} params
   */
  get(url, params) {
    return this.request({
      method: 'get',
      url,
      params: this.default ? merge(this.default, params) : params
    })
  }

  /**
   * Send a POST request to the given URL.
   *
   * @param {string} url
   * @param {object} data
   */
  post(url, data) {
    return this.request({
      method: 'post',
      url,
      data: this.default ? merge(this.default, data) : data
    })
  }

  /**
   * Submit the form.
   *
   * @param {object} config
   */
  request(config) {
    this.errors.clear()
    this.processing = true

    // prepend base url
    if (this.baseUrl) {
      config.url = this.baseUrl + config.url
    }

    return new Promise((resolve, reject) => {
      axios
        .request(config)
        .then(response => {
          // console.log('response', response)

          this.processing = false
          this.dirty = false
          this.errors.clear()

          this.message =
            response.data && response.data.message ? response.data.message : ''

          this.errorField =
            response.data && response.data.errorField
              ? response.data.errorField
              : ''

          this.status =
            response.data && response.data.status
              ? response.data.status
              : 'success'

          resolve(response)
        })
        .catch(error => {
          // console.log('error', error)

          this.processing = false
          this.errors.record(error)

          this.message = parseErrorMessages(error)

          this.errorField =
            error.response &&
            error.response.data &&
            error.response.data.errorField
              ? error.response.data.errorField
              : ''

          this.status =
            error.response && error.response.data && error.response.data.status
              ? error.response.data.status
              : 'error'

          reject(error)
        })
    })
  }
}

export default Form
