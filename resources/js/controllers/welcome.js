module.exports = function (core, user) {
  core.resource.project.get().then(function (res) {
    if (res.total) {
      $('#profile-link').removeClass('hide')
    }
  })
}
