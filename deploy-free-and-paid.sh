#!/bin/sh


PAID="ci-modern-doctors-office.zip"
FREE="ci-modern-doctors-office-free.zip"

scp $PAID 7fcnr0xvwk1nik@sftp.rax.ord.openhostingservice.com:/ci-modern-doctors-office/htdocs/downloads/themes/$PAID
scp $FREE 7fcnr0xvwk1nik@sftp.rax.ord.openhostingservice.com:/ci-modern-doctors-office/htdocs/downloads/themes/$FREE

PAID_METADATA="ci-modern-doctors-office-free_version_metadata.json"
FREE_METADATA="ci-modern-doctors-office_version_metadata.json"

scp $PAID_METADATA 7fcnr0xvwk1nik@sftp.rax.ord.openhostingservice.com:/ci-modern-doctors-office/htdocs/downloads/themes/$PAID_METADATA
scp $FREE_METADATA 7fcnr0xvwk1nik@sftp.rax.ord.openhostingservice.com:/ci-modern-doctors-office/htdocs/downloads/themes/$FREE_METADATA
