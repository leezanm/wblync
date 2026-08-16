                    ADMIN 1
                       │
                       ▼
             Monitoring Form Setup
                       │
                       ▼
              Fixed Form Structure
                       │
             ┌─────────┴─────────┐
             │                   │
        Edit Content        Versioning
             │                   │
             └─────────┬─────────┘
                       ▼
                Active Template
                       │
                       ▼
                   LECTURER
                       │
              ┌────────┴────────┐
              ▼                 ▼
          Student A          Student B
              │                 │
              ▼                 ▼
         Lawatan 1           Lawatan 1
         Lawatan 2           Lawatan 2
         Lawatan 3           Lawatan 3


         monitoring_form_templates
        │
        └── monitoring_form_sections
                  │
                  └── monitoring_form_items
                           │
                           └── monitoring_form_options

                           Contoh 

Template v1
│
├── 1. SEMAKAN BUKU LOG
│     ├── Kejelasan Penulisan
│     │      ├── Sangat Lemah
│     │      ├── Lemah
│     │      ├── Memuaskan
│     │      ├── Baik
│     │      └── Sangat Baik
│     │
│     └── Penulisan yang Sistematik
│            └── 5 options
│
├── 2. PEMERHATIAN...
│     ├── Kebolehan Melaksanakan Tugas
│     ├── Kehadiran
│     └── Disiplin
│
└── 3. PEMANTAUAN UMUM KURSUS
      ├── Soalan 1
      ├── Soalan 2
      ├── Soalan 3
      └── Ulasan Keseluruhan

Monitoring Form Setup
│
├── Version 1
│   └── Active
│
├── Version 2
│   └── Draft
│
└── Version 3
    └── Archived


Admin 1
   ↓
Monitoring Form Setup
   ↓
Active Version
   ↓
[View / Edit?]
   ↓
Create New Version
   ↓
Draft
   ↓
Edit Content
   ↓
Activate
