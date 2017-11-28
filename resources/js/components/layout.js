module.exports = function (core, user) {
  if (user && user.bam_cd_user) {
    core.service.databind('#main-menu', user.bam_cd_user)
    core.service.databind('#main-navbar-collapse', user.bam_cd_user)
  }
}
