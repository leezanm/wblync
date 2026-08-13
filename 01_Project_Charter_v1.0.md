# WBLync Project Charter v1.0

## Project

WBLync -- Smart Work-Based Learning Monitoring System

## Purpose

Develop an integrated platform to manage, monitor and evaluate
Work-Based Learning (WBL).

## Vision

Digitise the complete WBL lifecycle for students, lecturers, industry
mentors and coordinators.

1. Academic Session       ✅
        │
        ├── 2. Semester   ✅
        │
        └── 3. Programme. ✅
                 │
                 ├── 4. Course ✅
                 │
                 └── 5. Class✅
                         │
                         └── 6. Student ✅

Academic Session     ✅
Semester             ✅
Programme            ✅
Course               ✅
Class Room           ✅
Student              ✅

Relationship utama: 

Academic Session
      │
      ▼
   Semester
      │
      ├──────────► Programme
      │                │
      │                └── Course
      │
      ▼
  Class Room
      │
      ▼
   Student


   enrollments
├── student_id
├── course_id
└── class_room_id