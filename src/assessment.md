COURSE
   │
   ▼
ASSESSMENT
   │
   ├── Assessor Type
   │      ├── Lecturer
   │      └── Industry Mentor
   │
   └── VERSION
         │
         ├── Section
         │     └── Criteria
         │           └── Rating
         │
         └── CLO


STUDENT
   │
   ▼
STUDENT ASSESSMENT
   │
   ├── Assessor Type
   ├── Assessor
   ├── Scores
   └── Result


   Final
   COURSE
  │
  └── ASSESSMENT
        │
        ├── Assessor Type
        │     ├── Industry Mentor
        │     ├── Lecturer
        │     └── ...
        │
        └── VERSION
              │
              ├── CLO Mapping
              │
              └── SECTION
                    │
                    └── CRITERIA
                          │
                          └── RATING LEVELS


STUDENT
   │
   └── STUDENT ASSESSMENT
          │
          ├── Assessment Version
          ├── Assessor Type
          ├── Assessor
          ├── Scores
          ├── Total
          ├── Percentage
          └── Remarks

cth:

DVV402411 Video Production
│
├── Company Appraisal
│     Assessor: Industry Mentor
│
└── Project
      Assessor: Lecturer


DVV50256 Lighting Production
│
├── Demonstration
│     Assessor: Lecturer
│
└── Project
      Assessor: Lecturer


table
assessment_templates
assessment_versions
assessment_sections
assessment_criteria
assessment_rating_levels
assessment_version_clos
student_assessments
student_assessment_scores


model_relation
Course
  → AssessmentTemplate
      → AssessmentVersion
          → Sections
              → Criteria
                  → RatingLevels
