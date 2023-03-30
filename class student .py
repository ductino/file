class Student:
    def __init__(self):
        self.id = int(input('Hay nhap id: '))
        self.name = input('Hay nhap Ten sinh vien: ')
        self.grades = {}
        self.gpa = 0

    def print_info(self):
        print(f'student ID: {self.id}')
        print(f'student name: {self.name}')
        for subject in self.grades:
            print(f'{subject}: {self.grades[subject]}')
        print(f'student gpa: {self.gpa}')

    def calculate_gpa(self):
        total = 0
        for subject in self.grades:
            total += self.grades[subject]
        self.gpa = total / len(self.grades)

    def add_new_subject(self):
        so_mon_muon_nhap = int(input('Hay nhap so mon moi: '))
        for i in range(so_mon_muon_nhap):
            new_subject = input('Hay nhap mon hoc moi: ')
            self.grades[new_subject] = float(input(f'Hay nhap diem cho mon hoc {new_subject}'))

student_1 = Student()
student_1.add_new_subject()
student_1.calculate_gpa()
student_1.print_info()
