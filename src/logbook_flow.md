weekly_logbook_submissions
├── id
├── uuid
├── placement_id
├── week_start_date
├── week_end_date
├── status
├── submitted_at
├── reviewed_at
├── reviewed_by
├── remarks
└── timestamps

Weekly Submission
       │
       └── hasMany
              ↓
       Daily Logbooks

Weekly Submission #1
01/09 - 07/09
Status: Submitted
       │
       ├── 01/09 Working
       ├── 02/09 Working
       ├── 03/09 Working
       ├── 04/09 Off Day
       ├── 05/09 Working
       ├── 06/09 MC
       └── 07/09 Working

Placement
│
├── Student
├── Company
├── Industry Supervisor
│
└── Weekly Logbook Submissions
       │
       ├── Week 1
       │    ├── Daily Logbook
       │    ├── Daily Logbook
       │    ├── Daily Logbook
       │    ├── Daily Logbook
       │    ├── Daily Logbook
       │    ├── Daily Logbook
       │    └── Daily Logbook
       │
       ├── Week 2
       │    └── ...
       │
       └── Week 3
            └── ...


Daily Status

Draft
   ↓
Submitted
   ↓
Approved

atau

Submitted
   ↓
Rejected
   ↓
Student Edit
   ↓
Resubmit

Working Status

Working
Off Day
Public Holiday
Leave
Medical Leave

Student flow:

Student
  ↓
Daily Logbook
  ↓
Pilih Work Status
  ├── Working
  ├── Off Day
  ├── Public Holiday
  ├── Leave
  └── Medical Leave
  ↓
Save
  ↓
Submit This Week
  ↓
Weekly Submission = Submitted
  ↓
Industry Supervisor
  ↓
Approve / Reject

Flow

Student
  ↓
daily-logbooks.index
  ↓
Active Placement
  ↓
Current Week
  ↓
Daily Logbooks
  ↓
Weekly Submission Status
