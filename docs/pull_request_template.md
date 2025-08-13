# Pull Request Checklist:

# Pre-Approval

- [ ] There is a description section in the pull request that details what the proposed changes do. It can be very brief if need be, but it ought to exist.
- [ ] Comment which GitHub issue(s), if any does this PR address
- [ ] Features and backlog bugs should be merged into the `Development` branch, **NOT** `main`
- [ ] Hotfixes should be branched off of the `main` branch and PR'd using the **merge** option (not squashed) into the `hotfix` branch.
- [ ] [Symbiota coding standards](https://docs.google.com/document/d/1-FwCZP5Zu4f-bPwsKeVVsZErytALOJyA2szjbfSUjmc/edit?usp=sharing) have been followed
- [ ] New files have been autoformatted to agreed-upon auto-formatting standards

# Post-Approval

- [ ] It is the code author's responsibility to merge their own pull request after it has been approved
- [ ] If this PR represents a merge into the `Development` branch, remember to use the **squash & merge** option
- [ ] If this PR represents a merge into the `hotfix` branch, remember to use the **merge** option (i.e., no squash).
- [ ] If this PR represents a merge from the `Development` branch into the main branch, remember to use the **merge** option
- [ ] If this PR represents a merge from the `hotfix` branch into the `main` branch use the **squash & merge** option
  - [ ] a subsequent PR from `main` into `Development` should be made with the **merge** option (i.e., no squash).
  - [ ] **Immediately** delete the `hotfix` branch and create a new `hotfix` branch
  - [ ] TODO increment the SymbiotaServices version number in the relevant file commit to the `hotfix` branch.
- [ ] If the dev team has agreed that this PR represents the last PR going into the `Development` branch before a tagged release (i.e., before an imminent merge into the main branch), make sure to notify the team and [lock the `Development` branch](https://github.com/Symbiota/SymbiotaServices/settings/branches) to prevent accidental merges while QA takes place. Follow the release protocol [here](https://github.com/BioKIC/Symbiota/blob/main/docs/release-protocol.md).
- [ ] Don't forget to delete your feature branch upon merge. Ignore this step as required.

Thanks for contributing and keeping it clean!
