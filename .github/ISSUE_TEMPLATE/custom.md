---
name: Custom issue template
about: Describe this issue template's purpose here.
title: ''
labels: ''
assignees: ''

---

name: Feature / Task
description: Copilotに実装させるタスク
title: "[Feature] "
body:
  - type: textarea
    attributes:
      label: Goal
      description: 何を実現したいか
    validations:
      required: true

  - type: textarea
    attributes:
      label: Acceptance Criteria
      description: 完了条件（箇条書き）
    validations:
      required: true

  - type: textarea
    attributes:
      label: Out of scope
      description: 今回やらないこと
    validations:
      required: false

  - type: textarea
    attributes:
      label: Tests
      description: 確認方法（lint, unit, 手動など）
    validations:
      required: true
