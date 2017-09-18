/**

this program takes the student's answer and attempts to compile it using
the BeanShell library. if the answer does not compile, points are taken off
and an attempt to correct the answer is made in order to re-compile. if program
still does not compile, more points are removed.

if the program does compile, it is run using the test case(s). points are taken off
accordingly for any errors that occur upon output and student's answer is compared
to correct answer to check for similarity in order to give partial credit.

if program does compile and all test cases match the output of the correct answer,
no points are taken off and the student is given full credit.

*/

import java.text.DecimalFormat;
import java.text.NumberFormat;
import java.util.*;
import java.io.*;

import bsh.EvalError;
import bsh.Interpreter;

public class test {	
	
	public static String comments = "";
	public static double test_total = 0;
	public static double sim_total = 0;
	public static double total = 0;
	public static int cnt = 1;
	public static boolean isstatic = false;
	public static boolean isvoid = false;
	
	public static void main(String[] args) throws IOException{
		String s_code = args[0];
		String i_code = args[1];
		test_total = (Double.parseDouble(args[2]))*.4;
		sim_total = (Double.parseDouble(args[2]))*.6;
		String s_format = format(s_code);
		String i_format = format(i_code);
		String[] s_compare = s_format.split("\\s+");		
		String[] i_compare = i_format.split("\\s+");
		ArrayList<String> list = new ArrayList<String>();
		
		//FIND LOCATION 
		int iparen = 0;
		for(int i = 0; i < i_compare.length; i++){
			if(i_compare[i].equals(")")){
				iparen = i;
				break;
			}
		}
		int sparen = 0;		
		for(int i = 0; i < s_compare.length; i++) {
			if(s_compare[i].equals(")")) {
				sparen = i;
				break;
			}
		}
		int sbracket = 0;
		for(int i = 0; i < s_compare.length; i++) {
			if(s_compare[i].equals("{")) {
				sbracket = i;
				break;
			}
		}		
		
		//GET METHOD INITIALIZATION OF INSTRUCTOR AND PUT IN ARRAYLIST
		ArrayList<String> i_init_method = new ArrayList<String>();
		i_init_method = getMethodInit(i_compare, iparen);
		
		//GET METHOD INIZIALIZATION OF STUDENT AND PUT IN ARRAYLIST
		ArrayList<String> s_init_method = new ArrayList<String>();
		s_init_method = getMethodInit(s_compare, sparen);
		
		String i_access = "";
		String s_access = "";
		//CHECK IF CORRECT METHOD ACCESS MODIFIER, ADJUST ACCORDINGLY
		i_access = i_init_method.get(0);
		s_access = s_init_method.get(0);
		
		if(!s_access.equals(i_access)){
			s_init_method = setAccess(s_init_method, i_init_method);
		}
		
		/**
		 * WILL NEVER BE VOID BECAUSE USING ONLY METHODS, NOT FUNCTIONS
		 * METHODS RETURN, FUNCTIONS DO NOT, VOIDS DONT RETURN
		 */
		
		
		String s_type = "";
		String i_type = "";
		//GET STUDENT AND INSTRUCTOR RETURN TYPE
		s_type = s_init_method.get(1);
		i_type = i_init_method.get(1);
		
		//IF STUDENT RETURN TYPE INCORRECT, ADD ERROR AND SET STUDENT RETURN TYPE TO CORRECT TYPE
		if(!s_type.equals(i_type)){
			s_init_method = setReturn(s_init_method, s_type, i_type);
			s_type = i_type;
		}	
		
		String s_method = "";
		String i_method = "";
		//GET INSTRUCTOR AND STUDENT METHOD NAMES, STILL GOING TO BE AT INDEX 2 BECAUSE REMOVED STATIC
		s_method = s_init_method.get(2);
		i_method = i_init_method.get(2);	
		
		//IF STUDENT METHOD NAME NOT SAME METHOD NAME AS INSTRUCTORS, ADD ERROR AND SET CORRECT METHOD NAME
		if(!s_method.equals(i_method)){
			s_init_method = setMethod(s_init_method, s_method, i_method);
		}
		
		//IF MISSING LEFT PARENTHESIS, ADJUST ACCORDINGLY
		if(!s_init_method.get(3).equals("(")){
			System.out.println("MISSING PAREN");
			test_total = test_total * .95;
			comments += "(" + cnt + ") Missing left parenthesis after method name. ";
			cnt++;
			s_init_method.add(3, "(");
		}
		
		//MAX NUM OF PARAMETERS IS 4
		String[] s_parameters = new String[4];
		String[] i_parameters = new String[4];		
		int rparen = s_init_method.indexOf(")");
		int x = 0;
		
		//FIRST LPAREN SHOULD BE AT INDEX 3, INCREMENT BY ONE TO GET WHERE FIRST PARAMETER SHOULD BE = 4
		for(int i = 4; i < rparen; i++){
			String var = s_init_method.get(i).trim();
			if(var.contains("String")){
				s_parameters[x] = "String";
				x++;				
			} else if (var.contains("int")){
				s_parameters[x] = "int";
				x++;
			} else if (var.contains("boolean")){
				s_parameters[x] = "boolean";
				x++;
			} else if (var.contains("char")){
				s_parameters[x] = "char";
				x++;
			} else if (var.contains("long")){
				s_parameters[x] = "long";
				x++;
			} else if (var.contains("double")){
				s_parameters[x] = "double";
				x++;
			} else if (var.contains("float")){
				s_parameters[x] = "float";
				x++;
			}
		}
		//GET INSTRUCTOR PARAMETER TYPES
		rparen = i_init_method.indexOf(")");
		x = 0;
		for(int i = 4; i < rparen; i++){			
			String var = i_init_method.get(i).trim();
			if(var.contains("String")){
				i_parameters[x] = "String";
				x++;				
			} else if (var.contains("int")){
				i_parameters[x] = "int";
				x++;
			} else if (var.contains("boolean")){
				i_parameters[x] = "boolean";
				x++;
			} else if (var.contains("char")){
				i_parameters[x] = "char";
				x++;
			} else if (var.contains("long")){
				i_parameters[x] = "long";
				x++;
			} else if (var.contains("double")){
				i_parameters[x] = "double";
				x++;
			} else if (var.contains("float")){
				i_parameters[x] = "float";
				x++;
			}
		}
		
		//COPY CONTENTS OF S_PARAMETERS INTO ANOTHER ARRAY FOR TESTING INITIAL CODE
		String[] s_orig_parameters = new String[4];
		for(int i = 0; i < s_parameters.length; i++){
			s_orig_parameters[i]=s_parameters[i];
		}
		
		//IF DOESNT CONTAIN TRAILING RPAREN, ADJUST SCORE
		if(!s_init_method.contains(")")){
			test_total = test_total * .95;
			comments +=  "(" + cnt + ") Missing right parenthesis after method declaration. ";
			cnt++;
		}
		
		//SET STUDENT INITIALIZER
		String s_code_correct = "";
		for(int i = 0; i < s_init_method.size(); i++){
				s_code_correct += s_init_method.get(i) + " ";
		}
		
		//ADD REST OF CODE TO STUDENTS ANSWER STARTING AT LBRACKET		
		list.add("."); list.add("-"); list.add("("); list.add(")"); list.add("+"); list.add("/"); 
		list.add(";"); list.add("*"); list.add("="); list.add("{"); list.add("}"); list.add("!"); 
		for(int i = sbracket; i < s_compare.length; i++) {
			if((i+1) < s_compare.length && (list.contains(s_compare[i+1]) || list.contains(s_compare[i]))){
				s_code_correct += s_compare[i];
			} else {
				s_code_correct += s_compare[i] + " ";
			}
		}
		list.clear();
		
		//TEST IF ORIGINAL CODE COMPILES
		String s_init = buildCode(s_code, s_type, s_method, args, s_orig_parameters);			
		String s_run = buildCode(s_code_correct, s_type, i_method, args, s_parameters);
		String i_run = buildCode(args[1], i_type, i_method, args, i_parameters);
		
		
		/**
		 * CYCLE THROUGH PARAMETERS AND COMPARE TO INSTRUCTORS.
		 * IF TYPE MATCHES, REMOVE FROM BOTH. AFTER, IF THERE IS A 
		 * SINGLE ELEMENTS LEFT IN S_PARAMETERS THAT IS NOT NULL, THEN
		 * THE PARAMETERS ARE NOT OF THE SAME TYPES.
		 */
		for(int i = 0; i < s_parameters.length; i++){
			for(x = 0; x < i_parameters.length; x++){
				if(s_parameters[i] != null && i_parameters[x] != null){
					if(s_parameters[i].equals(i_parameters[x])){
						s_parameters[i] = null;
						i_parameters[x] = null;
					}
				}
			}
		}		
		for(int i = 0; i < s_parameters.length; i++){
			if(s_parameters[i] != null){
				test_total = test_total * .95;
				comments += "(" + cnt + ") Incorrect parameter types. ";
				cnt++;
			}
		}
		
		String s_out = output(s_run);
		String i_out = output(i_run);	
		String s_test = output(s_init);	
		s_init_method.clear();
		i_init_method.clear();
		
		int i_length = i_compare.length;
		int s_length = s_compare.length;
		double temp = sim_total/i_length;
		sim_total = 0;
		for(int i = 0; i < i_length; i++){
			for(x = 0; x < s_length; x++){
				if(i_compare[i] != null){
					if(s_compare[x] != null){
						if(i_compare[i].equals(s_compare[x])){
							i_compare[i] = null;
							s_compare[x] = null;
							sim_total += temp;
						}
					}
				}
			}
		}
		
		//IF ORIGINAL TEST IS NOT NULL, CORRECTED CODE WILL NO BE NULL EITHER
		if(s_test != null) {
			//IF CORRECTED CODE OUTPUT DOES NOT EQUAL INSTRUCTORS OUTPUT:
			if(!s_out.equals(i_out)){
				//IF NO ERRORS MADE IN METHOD INITIALIZATION, GIVE POINTS FOR CORRECT INITIALIZATION
				if(cnt  == 1) {
					test_total = test_total * .15;
					comments += "(" + cnt + ") Output does not match correct output after attempting to correct. ";
					cnt++;
				} 
				//IF ERRORS MADE IN METHOD INITIALIZATION, GIVE ZERO FOR MULTIPLE MISTAKES
				else {
					test_total = 0;
					comments += "(" + cnt + ") Output does not match correct output after attempting to correct. ";
					cnt++;
					comments += "(" + cnt + ") Multiple mistakes made throughout answer. ";
					cnt++;
				}
			} 
			//IF ORIGINAL TEST COMPILES AND CORRECTED CODE MATCHES OUTPUT OF INSTRUCTORS CODE
			//DO NOT ALTER SCORE ANY FURTHER (TAKING POINTS OFF)
			else{
				if(cnt == 1){
					comments = "(1) Answer is correct";
				}				
			}
		} 
		//IF ORIGINAL TEST DOES NOT COMPILE (POINTS WERE ALREADY TAKEN OFF)
		else if(s_test == null){
			//IF CORRECTED CODE DOES COMPILE
			if(s_out != null){
				//IF CORRECTED CODE MATCHES INSTRUCTORS CODE, DO NOT TAKE ANY FURTHER POINTS OFF,
				//POINTS ALREADY TAKEN OUT FROM INCORRECT METHOD INITIALIZATION ABOVE
				if(s_out.equals(i_out)) {	
					comments += "(" + cnt + ") Outputs match once code is corrected of simple syntax errors. ";
					cnt++;
				} else {
					//GIVE POINTS FOR CORRECT METHOD INITIALIZATION
					if(cnt  == 1) {
						test_total = test_total * .15;
						comments += "(" + cnt + ") Output does not match correct output after attempting to correct. ";
						cnt++;
					} 
					//IF ERRORS MADE IN METHOD INITIALIZATION, GIVE ZERO FOR MULTIPLE MISTAKES
					else {
						test_total = 0;
						cnt = 1;
						comments = "(" + cnt + ") Output does not match correct output after attempting to correct. ";
						cnt++;
						comments += "(" + cnt + ") Multiple mistakes made throughout answer. ";
						cnt++;
					}
				}
			} else {
				test_total = 0;
				comments += "("+cnt+") Syntax errors made in method body. ";
				cnt++;
			}
		} 
		
		if(sim_total == (Double.parseDouble(args[2]))*.6){
			total = Double.parseDouble(args[2]);
		} else if (test_total == ((Double.parseDouble(args[2]))*.4)) {
			total = Double.parseDouble(args[2]);
		}
		
		total = test_total + sim_total;
		NumberFormat formatter = new DecimalFormat("#0.00");     
		total = Double.parseDouble(formatter.format(total));		
		
		System.out.println(total);
		System.out.println(comments);
	}
	
	public static String format(String format) {
		String formatted = "";
		ArrayList<String> list = new ArrayList<String>();
		
		for(int i = 0; i< format.length(); i++){
			switch(format.charAt(i)){
			case '.':
				list.add(" ");				
				list.add(".");				
				list.add(" ");				
				break;
			case ';':
				list.add(" ");				
				list.add(";");				
				list.add(" ");				
				break;
			case '(':
				list.add(" ");				
				list.add("(");				
				list.add(" ");				
				break;
			case ')':
				list.add(" ");				
				list.add(")");				
				list.add(" ");				
				break;
			case '=':
				list.add(" ");				
				list.add("=");				
				list.add(" ");				
				break;
			case '+':
				list.add(" ");				
				list.add("+");				
				list.add(" ");				
				break;
			case '-':
				list.add(" ");				
				list.add("-");				
				list.add(" ");				
				break;
			case '>':
				list.add(" ");		
				list.add(">");				
				list.add(" ");			
				break;
			case '<':
				list.add(" ");				
				list.add("<");				
				list.add(" ");				
				break;
			case '{':
				list.add(" ");				
				list.add("{");				
				list.add(" ");				
				break;
			case '}':
				list.add(" ");				
				list.add("}");				
				list.add(" ");				
				break;
			default:
				list.add(Character.toString(format.charAt(i)));				
				break;
			}			
		}
		
		String[] answer = list.toArray(new String[list.size()]);
		for(int i = 0; i < answer.length; i++) {
			formatted += answer[i];
		}
		
		formatted = formatted.replaceAll("\\s+", " ");
		
		return formatted;
	}
	
	public static String output(String code) {
		String output = "";
		Interpreter i = new Interpreter();
		ByteArrayOutputStream b = new ByteArrayOutputStream();
		PrintStream ps = new PrintStream(b);
		PrintStream sp = System.out;
		System.setOut(ps);
		try {
			i.eval(code);
			output = b.toString();
			output = output.trim();
		} catch(EvalError e) {
			output = null;
		}	
		System.setOut(sp);		
		return output;
	}
	
	public static ArrayList<String> getMethodInit(String[] code, int iparen){
		ArrayList<String> init_method = new ArrayList<String>();
		for(int i = 0; i <= iparen; i++){
			init_method.add(code[i]);
		}
		return init_method;
	}
	
	public static ArrayList<String> setAccess(ArrayList<String> student, ArrayList<String> instructor){
		if(!(student.get(0).equals("public") || student.get(0).equals("private") || student.get(0).equals("protected"))) {
			test_total = test_total * .90;
			comments += "(" + cnt + ") No method access modifier used. Expected method access: " + instructor.get(0) + ". ";
			cnt++;
			student.add(0, instructor.get(0));
		} else if (!instructor.get(0).equals(student.get(0))){
			test_total = test_total * .95;
			comments += "(" + cnt + ") Incorrect method access modifier. Expected method access: " + instructor.get(0) + ". ";
			cnt++;
			student.set(0, instructor.get(0));
		}
		return student;
	}
	
	public static ArrayList<String> setMethod(ArrayList<String> student, String s_method, String i_method){
		if(s_method.equals("(")){
			student.add(2, i_method);
			test_total = test_total * .70;
			comments += "(" + cnt + ") No method name specified. Expected method name: " + i_method + ". ";
			cnt++;
		}else if(!s_method.equals(i_method)){
			student.set(2, i_method);
			test_total = test_total * .75;
			comments += "(" + cnt + ") Incorrect method name. Expected method name: " + i_method + ". ";
			cnt++;
		}
		return student;
	}
	
	public static ArrayList<String> setReturn(ArrayList<String> student, String s_type, String i_type){
		if((s_type.equals("String") || s_type.equals("double") || s_type.equals("int")|| s_type.equals("boolean")
		   || s_type.equals("long") || s_type.equals("float") || s_type.equals("char")) && (!s_type.equals(i_type))){			
			student.set(1, i_type);
			test_total = test_total * .95;
			comments += "(" + cnt + ") Incorrect return type. Expected return type: " + i_type + ". ";
			cnt++;
		} else {
			student.add(1, i_type);
			test_total = test_total * .90;
			comments += "(" + cnt + ") No return type specified. Expected return type: " + i_type + ". ";
			cnt++;
		}
		return student;
	}
	
	public static String buildCode(String code, String type, String method, String[] args, String[] params) {
		String st = "";
		String[] arg = new String[4];
		
		int o = 0;
		for(int i = 3; i < args.length; i++){
			if(args[i] != null){
				arg[o] = args[i];
				o++;
			}			
		}		
		
		String parameters = "";
		if(params != null){
			for(int i = 0; i < params.length; i++){
				for(int x = 0; x < arg.length; x++){
					if(params[i] != null){
						if(params[i].equals("String")){
							if(arg[x] != null){
								if(arg[x].startsWith("\"")){
									parameters += arg[x] + ", ";
									arg[x] = null;
									params[i] = null;
								}
							}
						} else if(params[i].equals("char")){
							if(arg[x] != null){
								if(arg[x].startsWith("\'")){
									parameters += arg[x] + ", ";
									arg[x] = null;
									params[i] = null;
								}
							}		
						} else {
							if(arg[x] != null){
								if(!arg[x].startsWith("\"") && !arg[x].startsWith("\'")){
									parameters += arg[x] + ", ";
									arg[x] = null;
									params[i] = null;
								}
							}
						}
					}
				}
			}
		}
		
		if(parameters.length() > 0){
			parameters = parameters.substring(0, parameters.length()-2);
		}			
	
		switch(args.length){
			case 4:
				st = type + " a = " + method + "(" + parameters + ");\nSystem.out.println(a);";
				break;
			case 5:
				st = type + " a = " + method + "(" + parameters + ");\nSystem.out.println(a);";
				break;
			case 6:
				st = type + " a = " + method +  "(" + parameters + ");\nSystem.out.println(a);";
				break;
			case 7:
				st = type + " a = " + method +  "(" + parameters + ");\nSystem.out.println(a);";
				break;
			default:
				System.out.println("System does not allow this many arguments.\n");
				System.exit(1);
		}
	
		StringBuilder s = new StringBuilder(st);		
		s.insert(0, code + "\n");	
		return s.toString();
	}
}
