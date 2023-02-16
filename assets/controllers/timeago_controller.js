import { Application } from '@hotwired/stimulus'
import Timeago from 'stimulus-timeago'

const application = Application.start()
application.register('timeago', Timeago)
