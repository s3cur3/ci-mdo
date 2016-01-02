#!/bin/sh


PAID="ci-modern-doctors-office.zip"
FREE="ci-modern-doctors-office-free.zip"

scp 7fcnr0xvwk1nik@sftp.rax.ord.openhostingservice.com:/ci-modern-doctors-office/htdocs/downloads/themes/$PAID $PAID
scp 7fcnr0xvwk1nik@sftp.rax.ord.openhostingservice.com:/ci-modern-doctors-office/htdocs/downloads/themes/$FREE $FREE

PAID_METADATA="ci-modern-doctors-office-free_version_metadata.json"
FREE_METADATA="ci-modern-doctors-office_version_metadata.json"

scp 7fcnr0xvwk1nik@sftp.rax.ord.openhostingservice.com:/ci-modern-doctors-office/htdocs/downloads/themes/$PAID_METADATA $PAID_METADATA
scp 7fcnr0xvwk1nik@sftp.rax.ord.openhostingservice.com:/ci-modern-doctors-office/htdocs/downloads/themes/$FREE_METADATA $FREE_METADATA
